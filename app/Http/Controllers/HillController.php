<?php

namespace App\Http\Controllers;

use App\Hill;
use App\Mountain;
use App\HillImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HillController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('hills.index', [
            'hills' => Hill::all()
        ]);
    }

    public function show( Request $request, Hill $hill ) {
        $request->session()->put('hillId', $hill->id);
        return view( 'hills.show', [
            'hill'  => $hill
        ] );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view( 'hills.create', [
            'mountains' => Mountain::all()
        ] );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $images = $request->file( 'images' );



        $request->validate([
            'name'              => 'required',
            'description'       => 'required',
            'height'            => 'required',
            'mountain'          => 'required',
            'lat'               => 'required',
            'long'              => 'required',
        ]);

        
        
        $hill = new Hill();
        $hill->name = $request->name;
        $hill->description = $request->description;
        $hill->height = $request->height;
        $hill->mountain_id = $request->mountain;
        $hill->latitude = $request->lat;
        $hill->longitude = $request->long;

        $hill->save();


        foreach( $images as $index => $img ) {
            $hill_image = new HillImage();
            $hill_image->hill_id = $hill->id; 
            $path = Storage::disk('public')->putFile('uploads', $img );
            $hill_image->path = '/storage/' . $path;
            $hill_image->save();

            
            
        }
        
        return redirect('hills/' . $hill->id);

    }


    public function track( $id ) {
        return view( 'hills.track', [
            'hill_id'   => $id,
        ] );
    }
}