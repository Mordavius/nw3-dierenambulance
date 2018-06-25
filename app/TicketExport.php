<?php
namespace App;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Ticket;

class TicketExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    use Exportable;
    public function __construct(string $startdate = null, string $enddate = null, string $animal = 'all', string $township = 'all', string $with_finances = 'true')
    {
        /*
        this is the constructor, in the constructor the parameters will be bound to the variables which will be used in the function.
        */

        //the earlier date
        $this->startdate = $startdate;
        //the current date
        $this->enddate   = $enddate;
        //the animal selected in export
        $this->animal_select = $animal;
        //the chosen township
        $this->township = $township;
        //exporting finances or not
        $this->with_finances = $with_finances;
    }

    public function headings(): array
    {
        //the headings that will be added to the top of the excel file
        $headings = [
            'Datum',
            'Tijd',
            'Centralist',
            'Bestuurder',
            'Bijrijder',
            'Diersoort',
            'Ras',
            'Geslacht',
            'Vangkooi',
            'Omschrijving dier',
            'Adres',
            'Postcode',
            'Stad',
            'Gemeente',
        ];
        //checks if finances need to be exported
        if ($this->with_finances == 'true'){
            array_push($headings, 'Factuur', 'Betaalmethode', 'Giften', 'Begin Kilometerstand', 'Eind Kilometerstand');
        }
        return $headings;
    }

    //creates an instance of a new ticket with default values
    function getNewTicket(){
        $new_ticket = [
            'date' => ' ',
            'time' => ' ',
            'dispatcher' => 'onbekend',
            'driver' => 'onbekend',
            'passenger' => 'onbekend',
            'species' => 'onbekend',
            'breed' => 'onbekend',
            'gender' => 'onbekend',
            'catch_cage' => 'n.v.t.',
            'animal_description' => 'onbekend',
            'address' => 'onbekend',
            'postal_code' => 'geen postcode',
            'city' => 'onbekend',
            'township' => 'onbekend',
        ];
        //checks if finances need to be exported
        if ($this->with_finances == 'true') {
            $new_ticket += [
                'invoice' => 'n.v.t.',
                'payment_method' => 'n.v.t.',
                'gifts' => 'n.v.t.',
                'startmilage' => 'n.v.t.',
                'endmilage' => 'n.v.t.'];
        }
        return $new_ticket;
    }

    // Grab all data from tickets between the $startdate and $enddate and all other constraints
    public function collection()
    {
        $collection_array = array();
	    $destinations2 = array();
        //this should never happen but if it does it acts as a get all
        if ($this->startdate === null && $this->enddate === null) {
            $tickets = Ticket::all();
        } else {
            //gets all the tickets between the two dates
            $tickets = Ticket::query()->whereBetween('date', [$this->enddate, $this->startdate])->get();
        }

        // loops through all retrieved tickets and checks if there are constraints
        foreach ($tickets as $ticket) {
	        $animal = null;
	        $destinations = null;
	        $destinations2 = null;

	        if ($this->animal_select != 'all') {
		        if ($ticket->animal && ($ticket->animal->animal_species == $this->animal_select)) {
			        $animal = $ticket->animal;
		        }
	        } else {
		        if ($ticket->animal) {
			        $animal = $ticket->animal;
		        }
	        }

	        if ($this->township != 'all') {
		        if ($ticket->mainDestination() && ($ticket->mainDestination()->township == $this->township)) {
			        $destinations = $ticket->mainDestination();
		        }
	        } else {
		        if ($ticket->mainDestination()) {
			        $destinations = $ticket->mainDestination();
		        }
	        }

	        if ($ticket->destinations && count($ticket->destinations) > 1) {
		        $destinations2 = end($ticket->destinations)[0];
	        }

            if ($this->with_finances == 'true') {
                $bus = $ticket->bus; // TODO: dit lijkt heulemaal niks te doen @girgis
            }

            //if all three exist generate a new ticket and fill it with data
            if ($ticket && isset($animal) && isset($destinations)) {
                $new_ticket = $this->getNewTicket();

                if ($ticket->date) {
                    $new_ticket['date'] = $ticket->date;
                }
                if ($ticket->time) {
                    $new_ticket['time'] = $ticket->time;
                }
                if ($ticket->centralist) {
                    $new_ticket['dispatcher'] = $ticket->centralist;
                }
                if ($ticket->driver) {
                    $new_ticket['driver'] = $ticket->driver;
                }
                if ($ticket->passenger) {
                    $new_ticket['passenger'] = $ticket->passenger;
                }


                if ($animal->animal_species) {
                    $new_ticket['species'] = $animal->animal_species;
                }
                if ($animal->breed) {
                    $new_ticket['breed'] = $animal->breed;
                }
                if ($animal->gender) {
                    $new_ticket['gender'] = $animal->gender;
                }
                if ($animal->catch_cage) {
                    $new_ticket['catch_cage'] = $animal->catch_cage;
                }
                if ($animal->description) {
                    $new_ticket['animal_description'] = $animal->description;
                }


                if ($destinations->postal_code) {
                    $new_ticket['postal_code'] = $destinations->postal_code;
                }
                if ($destinations->address) {
                    $new_ticket['address'] = $destinations->address . ' ' . $destinations->house_number;
                }
                if ($destinations->city) {
                    $new_ticket['city'] = $destinations->city;
                }
                if ($destinations->township) {
                    $new_ticket['township'] = $destinations->township;
                }

	            if ($this->with_finances == 'true') {
	                if ($destinations->milage) {
	                    $new_ticket['startmilage'] = $destinations->milage;
	                }
	                if ($destinations2 && $destinations2->milage){
	                    $new_ticket['endmilage'] = $destinations2->milage;
	                }
                }


                if ($this->with_finances == 'true') {
                    if ($ticket->payment_invoice) {
                        $new_ticket['invoice'] = $ticket->payment_invoice;
                    }
                    if ($ticket->payment_method) {
                        $new_ticket['payment_method'] = $ticket->payment_method;
                    }
                    if ($ticket->payment_gifts) {
                        $new_ticket['gifts'] = $ticket->payment_gifts;
                    }
                }
                //push new ticket to collection array
                array_push($collection_array, $new_ticket);
            }
        }

        //return collection to laravel/excel
        return new Collection($collection_array);
    }
}
