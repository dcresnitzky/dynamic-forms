<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Northwestern\SysDev\DynamicForms\ResourceRegistry;

class FormController extends Controller
{
    public function store(Request $request, ResourceRegistry $registry)
    {
        if ($request->get('state') === 'draft') {
            // Someone added a 'Save Draft' button to the form, and the user clicked that.
            // You can do some different behaviours if you'd like.
        }

        $data = $request->validateDynamicForm(
            $request->get('definition'), // get some definition JSON
            $request->get('submissionValues'),
            $registry
        );

        return view('form')->with([
            'definition' => $request->get('definition'), // get some definition JSON
            'data' => $data, // you can edit a form by providing the old data
        ]);
    }
}
