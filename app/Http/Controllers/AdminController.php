<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    use AuthenticationTrait;

    /**
     * @var string
     */
    public $guardName = 'admins';

    /**
     * @return array
     */
    public function dashboard()
    {
        return [
            'stats' => Contact::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as contacts'),
                'client_id'
            )
                ->groupBy('date', 'client_id')
                ->get()
        ];
    }
}
