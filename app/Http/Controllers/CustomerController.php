<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id', 'asc')->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|max:20',
            'address' => 'required',
            'line_id' => 'nullable|max:100'
        ]);

        $data = $request->only(['name', 'email', 'phone', 'address', 'line_id']);

        Customer::create($data);
        Alert::success('สำเร็จ', 'เพิ่มลูกค้าสำเร็จ');
        return redirect()->route('customers.index');
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|max:20',
            'address' => 'required',
            'line_id' => 'nullable|max:100'
        ]);

        $data = $request->only(['name', 'email', 'phone', 'address', 'line_id', 'line_id']);

        $customer->update($data);
        Alert::success('สำเร็จ', 'แก้ไขข้อมูลลูกค้าสำเร็จ');
        return redirect()->route('customers.index');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        Alert::success('สำเร็จ', 'ลบลูกค้าสำเร็จ');
        return redirect()->route('customers.index');
    }
}