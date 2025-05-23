<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Contact::where('user_id', auth()->id())
            ->select('name', 'email', 'phone')
            ->get();
    }

    public function headings(): array
    {
        return ['Name', 'Email', 'Phone'];
    }
}

