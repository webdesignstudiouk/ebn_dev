<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Sites as EBNSites;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Models\User;
use Excel;
use Storage;
use App\Models\Prospects;

class Sites extends Controller
{
	protected $sites;

	public function __construct()
	{
		$this->sites = new EBNSites;
	}

	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{

	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create(FormBuilder $formBuilder)
	{

	}

	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		$site = new EBNSites;
		$site->author_id = Auth::user()->id;
		$site->prospect_id = $request->prospect_id;
		$site->name = $request->name;
		$site->street_1 = $request->street_1;
		$site->street_2 = $request->street_2;
		$site->street_3 = $request->street_3;
		$site->street_4 = $request->street_4;
		$site->town = $request->town;
		$site->city = $request->city;
		$site->county = $request->county;
		$site->post_code = $request->post_code;
		$site->save();

		return back()->withInput(['tab'=>'sites']);
	}

	/**
	* Display the specified resource.
	*
	* @param  \App\Users  $users
	* @return \Illuminate\Http\Response
	*/
	public function show($prospect, $site, FormBuilder $formBuilder){

    }

	public function export_sitelist($prospect)
	{
       $prospectModel = new Prospects();
       $prospect = $prospectModel->find($prospect);

       $file = Excel::load('public/excel/site_list.xlsx', function ( $excelSheetReader ) use($prospect) {
           $excelSheetReader->sheet('Site List', function($sheet) use($prospect) {

               // Company Name
               $sheet->cell('B1', function($cell)  use($prospect) {
                   $cell->setValue($prospect->company);
               });

               // Company Reg Number
               $sheet->cell('B10', function($cell)  use($prospect) {
                   $cell->setValue($prospect->regNumber);
               });

               // Company Reg Charity Number
               $sheet->cell('B11', function($cell)  use($prospect) {
                   $cell->setValue($prospect->regCharityNumber);
               });

               // Prepared Date
               $sheet->cell('G7', function($cell)  use($prospect) {
                   $cell->setValue(Carbon::now()->format('d/m/Y'));
               });

               // Prepared By
               $sheet->cell('G8', function($cell)  use($prospect) {
                   $cell->setValue(Auth::user()->first_name.' '.Auth::user()->second_name);
               });

               $row = 15;

               //sites
               foreach($prospect->sites as $site){
                   //gas meters
                   foreach($site->gasMeters as $gasMeter){
                       // Site Name
                       $sheet->cell('a'.$row, function($cell)  use($gasMeter) {
                           $cell->setValue($gasMeter->id.' '.$gasMeter->site->name);
                       });

                       // Site Address
                       $sheet->cell('b'.$row, function($cell)  use($gasMeter) {
                           $cell->setValue($gasMeter->site->street_1.', '.$gasMeter->site->street_2.', '.$gasMeter->site->town.', '.$gasMeter->site->city);
                       });

                       // Site Postcode
                       $sheet->cell('c'.$row, function($cell)  use($gasMeter) {
                           $cell->setValue($gasMeter->site->post_code);
                       });

                       // Meter supply
                       $sheet->cell('d'.$row, function($cell)  use($gasMeter) {
                           $cell->setValue('Gas');
                       });

                       // Meter mprn
                       $sheet->cell('e'.$row, function($cell)  use($gasMeter) {
                           $cell->setValue($gasMeter->mprn);
                       });

                       // Meter amr
                       $sheet->cell('g'.$row, function($cell)  use($gasMeter) {
                           if($gasMeter->amr == '0'){
                               $data = "no";
                           }elseif($gasMeter->amr == '1'){
                               $data = "yes";
                           }
                           $cell->setValue($data);
                       });

                       // Meter supplier
                       $sheet->cell('h'.$row, function($cell)  use($gasMeter) {
                           $cell->setValue($gasMeter->supplier);
                       });

                       // Meter start_date
                       $sheet->cell('p'.$row, function($cell)  use($gasMeter) {
                           $cell->setValue($gasMeter->start_date);
                       });

                       // Meter end date
                       $sheet->cell('q'.$row, function($cell)  use($gasMeter) {
                           $cell->setValue($gasMeter->end_date);
                       });

                       // Meter SC
                       $sheet->cell('o'.$row, function($cell)  use($gasMeter) {
                           $cell->setValue($gasMeter->current8c);
                       });

                       $row++;
                   }

                   //electric meters
                   foreach($site->electricMeters as $electricMeter){
                       // Site Name
                       $sheet->cell('a'.$row, function($cell)  use($electricMeter) {
                           $cell->setValue($electricMeter->id.' '.$electricMeter->site->name);
                       });

                       // Site Address
                       $sheet->cell('b'.$row, function($cell)  use($electricMeter) {
                           $cell->setValue($electricMeter->site->street_1.', '.$electricMeter->site->street_2.', '.$electricMeter->site->town.', '.$electricMeter->site->city);
                       });

                       // Site Postcode
                       $sheet->cell('c'.$row, function($cell)  use($electricMeter) {
                           $cell->setValue($electricMeter->site->post_code);
                       });

                       // Meter supply
                       $sheet->cell('d'.$row, function($cell)  use($gasMeter) {
                           $cell->setValue('Electric');
                       });

                       // Meter mprn
                       $sheet->cell('e'.$row, function($cell)  use($electricMeter) {
                           $cell->setValue($electricMeter->mpan_1.'-'.$electricMeter->mpan_2.'-'.$electricMeter->mpan_3.'-'.$electricMeter->mpan_4.'-'.$electricMeter->mpan_5.'-'.$electricMeter->mpan_6.'-'.$electricMeter->mpan_7);
                       });

                       // Meter amr
                       $sheet->cell('g'.$row, function($cell)  use($electricMeter) {
                           if($electricMeter->amr == '0'){
                               $data = "no";
                           }elseif($electricMeter->amr == '1'){
                               $data = "yes";
                           }
                           $cell->setValue($data);
                       });

                       // Meter supplier
                       $sheet->cell('h'.$row, function($cell)  use($electricMeter) {
                           $cell->setValue($electricMeter->supplier);
                       });

                       // Meter day rate
                       $sheet->cell('i'.$row, function($cell)  use($electricMeter) {
                           $cell->setValue($electricMeter->dayRate);
                       });

                       // Meter day rate
                       $sheet->cell('j'.$row, function($cell)  use($electricMeter) {
                           $cell->setValue($electricMeter->nightRate);
                       });

                       // Meter kva allowance
                       $sheet->cell('m'.$row, function($cell)  use($electricMeter) {
                           $cell->setValue($electricMeter->kv_allowance);
                       });

                       // Meter start date
                       $sheet->cell('p'.$row, function($cell)  use($electricMeter) {
                           $cell->setValue($electricMeter->start_date);
                       });

                       // Meter end date
                       $sheet->cell('q'.$row, function($cell)  use($electricMeter) {
                           $cell->setValue($electricMeter->end_date);
                       });

                       // Meter fit
                       $sheet->cell('l'.$row, function($cell)  use($electricMeter) {
                           $cell->setValue($electricMeter->fit);
                       });

                       // Meter day eac
                       $sheet->cell('r'.$row, function($cell)  use($electricMeter) {
                           $cell->setValue($electricMeter->eac_day);
                       });

                       // Meter night eac
                       $sheet->cell('s'.$row, function($cell)  use($electricMeter) {
                           $cell->setValue($electricMeter->eac_night);
                       });

                       $row++;
                   }
               }

           });

       })->store('xlsx');

       dd($file);

		//return view('users.user', compact('form'))->with('user', $user);
	}

	/**
	* Show the form for editing the specified resource.
	*
	* @param  \App\Users  $users
	* @return \Illuminate\Http\Response
	*/
	public function edit($prospect, $site, FormBuilder $formBuilder)
	{
		$site = $this->sites->find($site);
		$prospect = $site->prospect;

		return view('prospects.prospect.site.edit')
		->with('site', $site)
		->with('prospect', $prospect);
	}

	public function electricMeters($prospect, $site, FormBuilder $formBuilder)
	{
		$site = $this->sites->find($site);
		$prospect = $site->prospect;

		$createElectricMeter = $formBuilder->create(\App\Forms\Sites\CreateElectricMeter::class, [
			'method' => 'POST',
			'url' => route('electricMeters.store', ['id' => $prospect->id, 'siteId' => $site->id]),
			'model' => $site
		]);

		return view('prospects.prospect.site.electricMeters')
		->with('site', $site)
		->with('prospect', $prospect)
		->with('createElectricMeter', $createElectricMeter);
	}

	public function gasMeters($prospect, $site, FormBuilder $formBuilder)
	{
		$site = $this->sites->find($site);
		$prospect = $site->prospect;

		$createGasMeter = $formBuilder->create(\App\Forms\Sites\CreateGasMeter::class, [
			'method' => 'POST',
			'url' => route('gasMeters.store', ['id' => $prospect->id, 'siteId' => $site->id]),
			'model' => $site
		]);

		return view('prospects.prospect.site.gasMeters')
		->with('site', $site)
		->with('prospect', $prospect)
		->with('createGasMeter', $createGasMeter);
	}

	public function delete($prospect, $site, FormBuilder $formBuilder)
	{
		$site = $this->sites->find($site);
		$prospect = $site->prospect;

		$deleteSiteForm = $formBuilder->create(\App\Forms\Sites\DeleteSite::class, [
			'method' => 'POST',
			'url' => route('sites.destroy', ['id' => $prospect->id, 'siteId' => $site->id]),
			'model' => $prospect
		]);

		return view('prospects.prospect.site.delete')
		->with('site', $site)
		->with('prospect', $prospect)
		->with('deleteSiteForm', $deleteSiteForm);
	}

	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \App\Users  $user
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request)
	{
		$site = $this->sites->find($request->id);
		$site->name = $request->name;
		$site->street_1 = $request->street_1;
		$site->street_2 = $request->street_2;
		$site->street_3 = $request->street_3;
		$site->street_4 = $request->street_4;
		$site->county = $request->county;
		$site->town = $request->town;
		$site->post_code = $request->post_code;
		$site->save();

		flash('Site Updated', 'success');

		return back();
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  \App\User  $user
	* @return \Illuminate\Http\Response
	*/
	public function destroy($prospect, $site)
	{
		$site = $this->sites->find($site);
		$site->delete();

		flash('Site Has Been Deleted', 'warning');

		return redirect()->route('prospects.edit', ['id'=>$prospect]);
	}
}
