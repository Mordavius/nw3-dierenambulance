var ticketfiltervalue;
var amountoftimes;
//var finishedtickets = document.getElementById('ticfin');
//var tfr =document.createElement('strong');



function deleteTicket(ticketid) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var conf =  confirm("Klik op OK om de melding te verwijderen!");
    if (conf == true) {
        var trdel = document.getElementById('trdel' + ticketid);
        trdel.parentNode.removeChild(trdel);
        $.ajax({
            type: 'DELETE',
            url: '/tickets/' + ticketid,
            success: function (data) {
                alert(data);
            }
        })
    }
}

function filterTickets() {
    ticketfiltervalue = $('#tf').val();
    amountoftimes = $('#times').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'GET',
        url: 'api/ticketfilter/'+amountoftimes +'/'+ ticketfiltervalue,
        success: function (data) {
            var i = 0;
            if (document.getElementById('finished') != null) {
                document.getElementById('finished').innerHTML = '';
                data.tickets.forEach(function () {
                   // if(data.tickets[i].finished > 0) {
                    document.getElementById('finished').innerHTML += '<tr id="trdel' + data.tickets[i].id + '">' +
                        '<td>' + data.animals[i].animal_species + '<br />' + data.animals[i].gender + '</td>' +
                        '<td>' + data.animals[i].description + '</td>' +
                        '<td>' + data.destinations[i].address + ' ' + data.destinations[i].house_number + '<br />' + data.destinations[i].postal_code + '<br />' + data.destinations[i].city + '</td>' +
                        '<td>' + data.tickets[i].date + '<br />' + data.tickets[i].time + '</td>' +
                        '<td><a href="/melding/' + data.tickets[i].id + '/edit"><i class="btn btn-primary">Aanpassen</i></a><br />' +
                        '<a href="/melding/"' + data.tickets[i].id + '></a><i class="btn btn-primary">Bekijk</i><br />' +
                        '<button class="btn btn-danger" onclick="deleteTicket(' + data.tickets[i].id + ')">Verwijderen</button> ' +
                        '</td>' +
                        '</tr>';
                    //}
                    document.getElementById('finishedtext').innerHTML = 'Afgeronde meldingen (gefilterd)';
                    i++;
                });
            }
            else {
                alert('Geen bestaande meldingen')
            }
        }
    });
}