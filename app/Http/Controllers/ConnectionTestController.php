<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ConnectionTestController extends Controller
{
    public function testConnection()
    {
        try {
            // Attempt to establish a connection to MongoDB
            DB::connection('mongodb')->getMongoClient();

            // If no exceptions are thrown, connection is successful
            return "Connection to MongoDB successful!";
        } catch (\Exception $e) {
            // Handle connection errors
            return "Error connecting to MongoDB: " . $e->getMessage();
        }
    }
}