<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelolaOrganisasi extends Controller
{
    public function index()
    {
        return view('pages.admin.profile-org.kelola-organisasi');
    }
}
