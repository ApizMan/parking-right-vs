<?php

namespace App\Livewire;

use App\Models\ParkingRight as ModelsParkingRight;
use Carbon\Carbon;
use DateTime;
use Livewire\Component;
use Livewire\WithPagination;

include_once app_path('constants.php');

class ParkingRight extends Component
{
    use WithPagination;

    public $datasApp = [];
    public $parkings = [];
    public $data_users = [];
    public $transactions = [];
    public $datas;

    public $parkingCountToday = 0;
    public $parkingCount = 0;
    public $appCount = 0;

    public function mount()
    {
        $this->appCount = count(ModelsParkingRight::where('terminal', 'CCP App')->get());
        $this->parkingCount = count(ModelsParkingRight::all());
        $this->migrateData();
    }

    public function getApiData($endpoint)
    {
        $baseUrl = rtrim(BASE_URL, '/');
        $url = $baseUrl . $endpoint;

        // dd($url);

        try {
            $data = file_get_contents($url);
            return json_decode($data, true);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function migrateData()
    {
        $this->parkings = $this->getApiData('/parking/public');
        $this->data_users = $this->getApiData('/auth/users');
        $this->transactions = $this->getApiData('/transaction/allTransactionWallet');

        $userMap = [];
        foreach ($this->data_users as $user) {
            $userMap[$user['id']] = $user;
        }

        $transactionMap = [];
        foreach ($this->transactions as $transaction) {
            $transactionMap[$transaction['id']] = $transaction;
        }

        foreach ($this->parkings as $parking) {
            // dd($this->parkings);
            $userId = $parking['userId'];
            $walletId = $parking['walletTransactionId'];

            $user = $userMap[$userId] ?? null;
            $transaction = $transactionMap[$walletId] ?? null;

            $startDate = (new DateTime($parking['createdAt']))->format('d-m-Y');
            $startTime = (new DateTime($parking['createdAt']))->format('h:i:s A');
            $endDate = (new DateTime($parking['expiredAt']))->format('d-m-Y');
            $endTime = (new DateTime($parking['expiredAt']))->format('h:i:s A');
            $creationDate = (new DateTime($transaction['createdAt'] ?? 'now'))->format('d-m-Y');
            $creationTime = (new DateTime($transaction['createdAt'] ?? 'now'))->format('h:i:s A');

            $this->datasApp[] = [
                'parking_id' => $parking['id'],
                'plate_number' => $parking['plateNumber'],
                'start_date' => $startDate,
                'start_time' => $startTime,
                'end_date' => $endDate,
                'end_time' => $endTime,
                'paid_amount' => $transaction['amount'] ?? null,
                'creation_date' => $creationDate,
                'creation_time' => $creationTime,
                'zone' => $parking['location'] . ' - ' . $parking['pbt'],
                'terminal' => 'CCP App',
                'transaction_no' => $parking['noReceipt'],
            ];
        }

        $this->transferDataToDatabase();
    }

    private function transferDataToDatabase()
    {
        // Step 1: Fetch all unique parking IDs from the database
        $existingParkingIds = ModelsParkingRight::pluck('parking_id')->toArray();

        // Step 2: Filter out records that already exist in the database
        $newData = array_filter($this->datasApp, function ($data) use ($existingParkingIds) {
            return !in_array((string)$data['parking_id'], $existingParkingIds); // Ensure type match for IDs
        });

        // Step 3: Insert new records with timestamps if there are any
        if (!empty($newData)) {
            $timestamp = now();
            $newDataWithTimestamps = array_map(function ($data) use ($timestamp) {
                $data['created_at'] = $timestamp;
                $data['updated_at'] = $timestamp;
                return $data;
            }, $newData);

            // Insert the filtered data into the database
            ModelsParkingRight::insert($newDataWithTimestamps);

            // Count newly inserted records
            $this->parkingCountToday = count($newDataWithTimestamps);
        } else {
            $this->parkingCountToday = 0;
        }

        // Step 4: Refresh the dataset with distinct records from the database
        $this->datas = ModelsParkingRight::distinct()->get();

        // Step 5: Calculate parkingCount based on today's date and time
        $currentDateTime = now();
        $this->parkingCountToday = $this->datas->filter(function ($data) use ($currentDateTime) {
            $startDateTime = Carbon::createFromFormat('d-m-Y h:i:s A', $data->start_date . ' ' . $data->start_time);
            $endDateTime = Carbon::createFromFormat('d-m-Y h:i:s A', $data->end_date . ' ' . $data->end_time);

            return $startDateTime <= $currentDateTime && $endDateTime >= $currentDateTime;
        })->count();
    }

    public function render()
    {
        return view('livewire.parking-right');
    }
}
