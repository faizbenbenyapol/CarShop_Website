<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id', 'desc')->paginate(10);
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
            'phone' => 'nullable|max:20',
            'address' => 'nullable',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['name', 'email', 'phone', 'address']);

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('customers', 'public');
        }

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
            'phone' => 'nullable|max:20',
            'address' => 'nullable',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['name', 'email', 'phone', 'address']);

        if ($request->hasFile('profile_image')) {
            if ($customer->profile_image) {
                Storage::disk('public')->delete($customer->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('customers', 'public');
        }

        $customer->update($data);
        Alert::success('สำเร็จ', 'แก้ไขข้อมูลลูกค้าสำเร็จ');
        return redirect()->route('customers.index');
    }

    public function destroy(Customer $customer)
    {
        if ($customer->profile_image) {
            Storage::disk('public')->delete($customer->profile_image);
        }
        $customer->delete();
        Alert::success('สำเร็จ', 'ลบลูกค้าสำเร็จ');
        return redirect()->route('customers.index');
    }
}