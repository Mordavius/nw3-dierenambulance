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
    public function __construct(string $startdate = null, string $enddate = null, string $animal = null, string $township = null, string $with_finances = 'true')
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
            'Diersoort',
            'Ras',
            'Geslacht',
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
            'centralist' => 'onbekend',
            'animal_species' => 'onbekend',
            'breed' => 'onbekend',
            'gender' => 'onbekend',
            'description' => 'onbekend',
            'address' => 'onbekend',
            'postal_code' => 'geen postcode',
            'city' => 'onbekend',
            'township' => 'onbekend',
        ];
        //checks if finances need to be exported
        if ($this->with_finances == 'true') {
            $new_ticket += [
                'payment_invoice' => 'n.v.t.',
                'payment_method' => 'n.v.t.',
                'payment_gift' => 'n.v.t.',
                'startmilage' => 'n.v.t.',
                'endmilage' => 'n.v.t.'];
        }
        return $new_ticket;
    }

    function setTicketValue($ticket, array $new_ticket){
        $ticket_keys = ["date", "time", "centralist"];
        if ($this->with_finances == 'true'){
            array_push($ticket_keys, "payment_invoice", "payment_method", "payment_gift");
        }
        $current_value = "";

        for ($i = 0; $i <= count($ticket_keys)-1; $i++){
            $current_value = $ticket_keys[$i];
            if ($ticket->$current_value){
                $new_ticket[$current_value] = $ticket->$current_value;
            }
        }
        return $new_ticket;
    }

    function setAnimalValue($animal, array $new_ticket){
        $animal_keys = ['animal_species', 'breed', 'gender', 'description'];
        $current_value = "";
        for ($i = 0; $i <= count($animal_keys)-1; $i++) {
            $current_value = $animal_keys[$i];
            if ($animal->$current_value) {
                $new_ticket[$current_value] = $animal->$current_value;
            }
        }
        return $new_ticket;
    }

    function setDestinationValue($destinations, array $new_ticket){
        $destination_keys = ['address', 'postal_code', 'city', 'township'];
        $current_value = "";
        for ($i = 0; $i <= count($destination_keys)-1; $i++) {
            $current_value = $destination_keys[$i];
            if ($destinations->$current_value) {
                $new_ticket[$current_value] = $destinations->$current_value;
            }
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
            $tickets = Ticket::select('date','time','centralist', 'payment_invoice', 'payment_method' ,'payment_gift', 'id')->get();
        } else {
            //gets all the tickets between the two dates
            $tickets = Ticket::select('date','time','centralist', 'payment_invoice', 'payment_method' ,'payment_gift', 'id')->whereBetween('date', [$this->enddate, $this->startdate])->get();
        }


        // loops through all retrieved tickets and checks if there are constraints
        foreach ($tickets as $ticket) {
            $animal = null;
            $destinations = null;
            $destinations2 = null;

            if ($this->animal_select != null) {
                if ($ticket->animal && ($ticket->animal->animal_species == $this->animal_select)) {
                    $animal = $ticket->animal;
                }
            } else {
                if ($ticket->animal) {
                    $animal = $ticket->animal;
                }
            }

            if ($this->township != null) {
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

            //if all three exist generate a new ticket and fill it with data
            if ($ticket && isset($animal) && isset($destinations)) {
                $new_ticket = $this->getNewTicket();
                $new_ticket = $this->setTicketValue($ticket, $new_ticket);
                $new_ticket = $this->setAnimalValue($animal, $new_ticket);
                $new_ticket = $this->setDestinationValue($destinations, $new_ticket);

                if ($this->with_finances == 'true') {
                    if ($destinations->milage) {
                        $new_ticket['startmilage'] = $destinations->milage;
                    }
                    if ($destinations2 && $destinations2->milage){
                        $new_ticket['endmilage'] = $destinations2->milage;
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
