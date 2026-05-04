<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinkController extends Controller
{
    //
    public function create()
    {
        return 'Create Link - coming soon';
    }
    public function store(Request $request)
    {
        return 'Store Link - coming soon';
    }
    public function edit($id)
    {
        return 'Edit Link '.$id.' coming soon';
    }
    public function update($id)
    {
        return 'Update Link '.$id.' coming soon';
    }
    public function destroy($id)
    {
        return 'Delete Link '.$id.' coming soon';
    }
}
