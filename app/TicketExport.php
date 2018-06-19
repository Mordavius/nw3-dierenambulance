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
        $this->startdate = $startdate;
        $this->enddate   = $enddate;
        $this->animal_select = $animal;
        $this->township = $township;
        $this->with_finances = $with_finances;
    }

    public function headings(): array
    {

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

        if ($this->with_finances == 'true'){
            array_push($headings, 'Factuur', 'Betaalmethode', 'Giften', 'Kilometerstand');
        }

        return $headings;
    }

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
        if ($this->with_finances == 'true') {
            $new_ticket += [
                'invoice' => 'n.v.t.',
                'payment_method' => 'n.v.t.',
                'gifts' => 'n.v.t.',
                'milage' => 'n.v.t.'];
        }
        return $new_ticket;
    }

    // Grab all data from tickets between now and 3 months ago
    public function collection()
    {
        $collection_array = array();
        $tickets = '';


        if ($this->startdate === null && $this->enddate === null) {
            $tickets = Ticket::all()->get();
        } else {
            $tickets = Ticket::query()->whereBetween('date', [$this->enddate, $this->startdate])->get();
        }

        foreach ($tickets as $ticket) {
            if ($this->animal_select != 'all') {
                $animal = Animal::where([['id', $ticket->animal_id], ['animal_species', $this->animal_select],])->first();
            } else {
                $animal = Animal::where('id', $ticket->animal_id)->first();
            }
            if ($this->township != 'all') {
                $destinations = Destination::where([['ticket_id', $ticket->id], ['township', $this->township],])->first();
            } else {
                $destinations = Destination::where('ticket_id', $ticket->id)->first();
            }
            if ($this->with_finances == 'true') {
                $bus = Bus::where('id', $ticket->bus_id)->first();
                $finance = Finance::where('ticket_id', $ticket->id)->first();
            }


            if ($ticket && $animal && $destinations) {
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
                if ($destinations->milage) {
                    $new_ticket['milage'] = $destinations->milage;
                }


                if ($this->with_finances == 'true') {
                    if ($finance) {
                        if ($finance->payment_invoice) {
                            $new_ticket['invoice'] = $finance->payment_invoice;
                        }
                        if ($finance->payment_method) {
                            $new_ticket['payment_method'] = $finance->payment_method;
                        }
                        if ($finance->payment_gifts) {
                            $new_ticket['gifts'] = $finance->payment_gifts;
                        }
                    }
                }
                array_push($collection_array, $new_ticket);
            }
        }
        return new Collection($collection_array);
    }
}
