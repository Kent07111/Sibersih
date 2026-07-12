<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationqController extends Controller
{
    public function index(Request $request)
    {
        $query = Education::where('status','Publish');

        if($request->filled('search')){

            $query->where(function($q) use($request){

                $q->where(
                    'judul',
                    'like',
                    '%'.$request->search.'%'
                )

                ->orWhere(
                    'isi',
                    'like',
                    '%'.$request->search.'%'
                );

            });

        }

        if($request->filled('kategori')){

            $query->where(
                'kategori',
                $request->kategori
            );

        }

        $educations = $query
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $kategori = [

            'Organik',

            'Anorganik',

            'B3',

            'Minyak Jelantah',

            'Eco Enzyme',

            'Kompos',

            'Lainnya'

        ];

        return view(

            'guest.education.index',

            compact(

                'educations',

                'kategori'

            )

        );
    }

    public function show(Education $education)
    {
        $related = Education::where(

                'kategori',

                $education->kategori

            )

            ->where(

                'id',

                '!=',

                $education->id

            )

            ->where(

                'status',

                'Publish'

            )

            ->take(3)

            ->get();

        return view(

            'guest.education.show',

            compact(

                'education',

                'related'

            )

        );
    }
}