function Grafik(id) {

    document.getElementById("loading").style.display = "block";
    document.getElementById("prywatny").style.display = "none";

    $.get("json/grafik_zakres.php?przesuniecie=" + id, function (data) {

        var dane = JSON.parse(data);

        $.each(dane, function () {


            if (this.cofanie == 1) $("#prywatny").html('<button type="button" onclick="Grafik(' + (id - 1) + ')" class="btn btn-success btn-lg"><i class="fa fa-arrow-left" style="color: white;"></i></button>');
            else $("#prywatny").html('<button type="button" disabled class="btn btn-danger btn-lg"><i class="fas fa-times" style="color: white;"></i></button>');

            $("#prywatny").append('<button type="button" class="btn btn-light btn-lg" disabled=""><div id="nazwa">GRAFIK NA TYDZIEŃ <b>' + this.zakres + '</b></div></button>');

            if (this.przod == 1) $("#prywatny").append('<button type="button" onclick="Grafik(' + (id + 1) + ');" class="btn btn-success btn-lg"><i class="fa fa-arrow-right" style="color: white;"></i></button>');
            else $("#prywatny").append('<button type="button" disabled class="btn btn-danger btn-lg"><i class="fas fa-times" style="color: white;"></i></button>');


        });

        $.get("json/grafik_dni.php?przesuniecie=" + id, function (data) {

            var dane = JSON.parse(data);

            document.getElementById("prywatny").innerHTML += '<br /><br /><div class="table-responsive text-center" style="overflow-x: hidden; width:100%;"><table id="tabela" class="table-bordered " style="width: calc(100% - 1px); "></table></div>';
            document.getElementById("prywatny").innerHTML += '<div class="table-responsive text-center" style="overflow-x: hidden; width:100%;"><table id="tabelaMobile" class="table-bordered " style="width: calc(100% - 1px); "></table></div>';

            if ($(window).width() > 1260) {
                $("#tabela").css("display", "table")
                $("#tabelaMobile").css("display", "none")
            }
            else {
                $("#tabela").css("display", "none")
                $("#tabelaMobile").css("display", "table")
            }

            let line = $("<tr>")
            let mobileMain = []

            $.each(dane, function () {

                let zmienne = '';
                let klasy = '';

                if (this.swieto === "1") zmienne += 'color: #c00;';

                if (this.dzis === "1") klasy += 'grafikDzis ';


                line.append('<th scope="col" class="' + klasy + '" style="' + zmienne + '">' + this.dzien + '<br /> ' + this.data + '</th>');
                mobileMain.push('<tr scope="row" class="' + klasy + '" style="' + zmienne + '"><td class="col font-weight-bold">' + this.dzien + '<br /> ' + this.data + '</td></tr>');

            });

            $('#tabela').append(line);

            $.get("json/grafik_kursy.php?przesuniecie=" + id, function (data) {

                var dane = JSON.parse(data);

                let line = ""
                let desktopLine = []
                let mobileLine = []

                $.each(dane, function () {

                    let zmienne = 'min-height:100px;vertical-align: middle; width: calc(100% / 7);';
                    let klasy = ''

                    //kolorowanie dnia dzisiejszego

                    if (this.dzis === "1") klasy += 'grafikDzis ';

                    //wolne grafikowe i urlop

                    if (this.typ === "7") line += ('<td scope="col" class="' + klasy + '" style="' + zmienne + '"><b>' + this.wpis + '</b></td>');

                    if (this.typ === "4") line += ('<td scope="col" class="' + klasy + '" style="' + zmienne + '"><b style="color: orange;">' + this.wpis + '</b></td>');

                    //kurs z wolnego (woz zawsze pokazujemy)

                    if (this.typ === "2") line += ('<td scope="col" class="' + klasy + '" style="' + zmienne + '"><b>' + this.nazwa + this.zmiana + '</b><br />' + this.godzina_od + ' - ' + this.godzina_do + '<br /><small>' + (this.miejsce != "" ? (this.zmiana == "A" ? "Miejsce zakończenia służby: " : "Miejsce rozpoczęcia służby: ") : "") + this.miejsce + '</small><br /><b>' + this.marka + ' ' + this.model + ' #' + this.nr_tab + '</b><br /><small>' + this.nazwa_typu + '</small></td>');

                    //anulowanie i usprawiedliwienie kursu

                    if (this.typ === "3" || this.typ === "5" || this.typ === "8") line += ('<td scope="col" class="' + klasy + '" style="' + zmienne + '"><s><b>' + this.nazwa + this.zmiana + '</b><br />' + this.godzina_od + ' - ' + this.godzina_do + '<br /><small>' + (this.miejsce != "" ? (this.zmiana == "A" ? "Miejsce zakończenia służby: " : "Miejsce rozpoczęcia służby: ") : "") + this.miejsce + '</small><br /><b>' + this.marka + ' ' + this.model + ' #' + this.nr_tab + '</b><br /></s><small>' + this.nazwa_typu + '</small></td>');

                    //wyjazd z rezerwy

                    if (this.typ === "6") line += ('<td scope="col" class="' + klasy + '" style="' + zmienne + '"><b>' + this.nazwa + this.zmiana + '</b><br />' + this.godzina_od + ' - ' + this.godzina_do + '<br /><small>' + (this.miejsce != "" ? (this.zmiana == "A" ? "Miejsce zakończenia służby: " : "Miejsce rozpoczęcia służby: ") : "") + this.miejsce + '</small><br /><b>' + this.marka + ' ' + this.model + ' #' + this.nr_tab + '</b><br /><small>' + this.nazwa_typu + '</small></td>');

                    //kurs grafikowy

                    if (this.typ === "1") {

                        if (this.uzupelniony === "1") {

                            if (this.wozUkryty === "1")
                                line += ('<td scope="col" class="' + klasy + '" style="' + zmienne + '"><b>' + this.nazwa + this.zmiana + '</b><br />' + this.godzina_od + ' - ' + this.godzina_do + '<br /><small>' + (this.miejsce != "" ? (this.zmiana == "A" ? "Miejsce zakończenia służby: " : "Miejsce rozpoczęcia służby: ") : "") + this.miejsce + '</small><br /><small>' + this.nazwa_typu + '</small></td>');
                            else
                                line += ('<td scope="col" class="' + klasy + '" style="' + zmienne + '"><b>' + this.nazwa + this.zmiana + '</b><br />' + this.godzina_od + ' - ' + this.godzina_do + '<br /><small>' + (this.miejsce != "" ? (this.zmiana == "A" ? "Miejsce zakończenia służby: " : "Miejsce rozpoczęcia służby: ") : "") + this.miejsce + '</small><br /><b>' + this.marka + ' ' + this.model + ' #' + this.nr_tab + '</b><br /><small>' + this.nazwa_typu + '</small></td>');
                        } else
                            line += ('<td scope="col" class="' + klasy + '" style="' + zmienne + '"><small>' + this.nazwa_typu + '</small></td>');
                    }

                    let tr = $('<tr>').css("height", "150px")
                    tr.append(line)
                    mobileLine.push(tr)
                    desktopLine.push(line)
                    line = ""
                });
                let tabelaTr = $('<tr style="height: 250px;">');
                tabelaTr.append(desktopLine)
                $('#tabela').append(tabelaTr)

                mobileMain.forEach((element, index) => {
                    $('#tabelaMobile').append(element, mobileLine[index], "<br/>")
                })

                $.get("json/grafik_uwagi.php?przesuniecie=" + id, function (data) {

                    var dane = JSON.parse(data);

                    if (dane != "") {

                        $.each(dane, function () {

                            $('#tabela').append('<tr><td colspan="7" scope="col" class="text-left px-5 py-3"><small><b>' + this.dzien + ' (' + this.data + '):</b> ' + this.uwaga + '</small></td></tr>');

                        });


                    }

                    document.getElementById("loading").style.display = "none";
                    document.getElementById("prywatny").style.display = "block";

                });

            });

        });

    });


}


function PodgladKursu(id) {

    $("#modal-podglad-loading").css("display", "block");
    $("#modal-podglad-zawartosc").css("display", "none");

    $("#modal-edycja-przycisk").prop('disabled', true);
    $("#modal-usuwanie-przycisk").prop('disabled', true);

    $("#modal-edycja-przycisk").css("display", "block");
    $("#modal-usuwanie-przycisk").css("display", "block");
    $("#modal-zapisywanie-przycisk").css("display", "none");

    $("#modal-podglad").modal("show");

    $(".podglad").css("display", "block");
    $(".edycja").css("display", "none");

    $("#modal-edycja-pojazd-row").css("display", "block");
    $("#modal-edycja-plan-row").css("display", "block");

    $("#modal-edycja-loading-row").css("display", "none");

    $("#modal-edycja-opcje-row").css("display", "none");

    $("#modal-edycja-wymuszanie").css("display", "none");

    $.get("json/dyspozytornia_publiczna_podglad.php?id=" + id, function (data) {

        var dane = JSON.parse(data);

        $.each(dane, function () {

            if (this.edytowalny === "1") {

                $("#modal-edycja-przycisk").prop('disabled', false);
                $("#modal-usuwanie-przycisk").prop('disabled', false);

            }

            $("#modal-podglad-data").html(this.dzien + ' (' + this.data + ')');
            $("#modal-podglad-typ").html(this.nazwa_typu);

            $("#modal-podglad-plan").html(this.nazwa + this.zmiana + ' (' + this.godzina_od + ' - ' + this.godzina_do + ')');
            $("#modal-podglad-pojazd").html(this.marka + ' ' + this.model + ' #' + this.nr_tab);

            $("#modal-podglad-pojazd-id").val(this.idWozu);
            $("#modal-podglad-plan-id").val(this.id_plan);

            $("#modal-podglad-user").html(this.user);

            if (this.idWozu == this.id_stalka) checkbox = 1;
            else checkbox = 0;

            if (this.zgodny == 1) checkbox2 = 1;
            else checkbox2 = 0;

            stalka = this.id_stalka;

            if (this.wyswietlac_checkbox === "1") {

                $("#modal-podglad-stalka").html(this.marka_stalki + ' ' + this.model_stalki + ' #' + this.nr_tab_stalki);

                czyStalka = 1;

            } else {

                $("#modal-podglad-stalka").html("-");

                czyStalka = 0;
            }

            $("#modal-podglad-uwagi").html(this.uwaga);
            $("#modal-edycja-uwagi").val(this.uwaga);

            $("#modal-usuwanie-przycisk").val(this.id);

        });

        $("#modal-podglad-loading").css("display", "none");
        $("#modal-podglad-zawartosc").css("display", "block");


    });

}

function GrafikPubliczny(id) {

    GRAFIK = id;

    document.getElementById("loading").style.display = "block";
    document.getElementById("tresc").style.display = "none";
    document.getElementById("tresc2").style.display = "none";

    $.get("json/grafik_zakres.php?przesuniecie=" + id, function (data) {

        var dane = JSON.parse(data);

        $.each(dane, function () {


            if (this.cofanie == 1) $("#tresc").html('<button type="button" onclick="GrafikPubliczny(' + (id - 1) + ')" class="btn btn-success btn-lg"><i class="fa fa-arrow-left" style="color: white;"></i></button>');
            else $("#tresc").html('<button type="button" disabled class="btn btn-danger btn-lg"><i class="fas fa-times" style="color: white;"></i></button>');

            $("#tresc").append('<button type="button" class="btn btn-light btn-lg" disabled=""><div id="nazwa">GRAFIK NA TYDZIEŃ <b>' + this.zakres + '</b></div></button>');

            if (this.przod == 1) $("#tresc").append('<button type="button" onclick="GrafikPubliczny(' + (id + 1) + ');" class="btn btn-success btn-lg"><i class="fa fa-arrow-right" style="color: white;"></i></button>');
            else $("#tresc").append('<button type="button" disabled class="btn btn-danger btn-lg"><i class="fas fa-times" style="color: white;"></i></button>');

            $.get("json/grafik_dni.php?przesuniecie=" + id, function (data) {

                var dane = JSON.parse(data);

                $("#tresc2").html('<br /><br /><div class="table-responsive"><table id="tabela2" class="table table-bordered" style="width: calc(100%-1px);"></table></div>');

                let line = $('<tr>');

                line.append('<th scope="col" style="width: calc(100%/8)">KIEROWCA<BR />NR SŁUŻBOWY</th>');

                $.each(dane, function () {

                    let zmienne = 'width: calc(100%/8);'; 
                    let klasy = '';

                    if (this.swieto === "1") zmienne += 'color: #c00;';

                    if (this.dzis === "1") klasy += 'grafikDzis ';


                    line.append('<th scope="col" class="' + klasy + '" style="' + zmienne + '">' + this.dzien + '<BR /> ' + this.data + '</th>');

                });

                $('#tabela2').append(line);

                $.get("json/dyspozytornia_publiczna_grafik.php?przesuniecie=" + id, function (data) {

                    var dane = JSON.parse(data);

                    var i;

                    for (i = 0; i < dane.length; i++) {

                        let line = $('<tr>');

                        if (dane[i][0]['stalka'] == null) line.append('<td style="vertical-align: middle;"><b>' + dane[i][0]['kierowca'] + '</b><br /><small>' + dane[i][0]['nr_sluzbowy'] + '</small></td>');
                        else line.append('<td style="vertical-align: middle;"><b>' + dane[i][0]['kierowca'] + '</b><br /><small>' + dane[i][0]['nr_sluzbowy'] + '<br />' + dane[i][0]['stalka'] + '</small></td>');

                        var licz;

                        for (licz = 1; licz <= 7; licz++) {

                            let zmienne = '';
                            let klasy = '';


                            if (dane[i][licz]['dzis'] === "1") klasy += 'grafikDzis ';

                            switch (dane[i][licz]['typ']) {


                                case "7":

                                    line.append('<td class="' + klasy + '" style="vertical-align: middle; ' + zmienne + '"><b>' + dane[i][licz]['wolne'] + '</b></td>');

                                    break;

                                case "4":

                                    line.append('<td class="' + klasy + '" style="vertical-align: middle; ' + zmienne + '"><b style="color: orange;">' + dane[i][licz]['wolne'] + '</b></td>');

                                    break;

                                case "2":

                                    line.append('<td class="' + klasy + '" style="vertical-align: middle; ' + zmienne + '"><button type="button" class="btn btn-warning btn-lg" onClick="PodgladKursu(' + dane[i][licz]['id'] + ');"><b>' + dane[i][licz]['plan'] + dane[i][licz]['zmiana'] + '</b><br />' + dane[i][licz]['pojazd'] + '</button></td>');

                                    break;

                                case "3":

                                    line.append('<td class="' + klasy + '" style="vertical-align: middle; ' + zmienne + '"><button type="button" class="btn btn-danger btn-lg" onClick="PodgladKursu(' + dane[i][licz]['id'] + ');"><b><s>' + dane[i][licz]['plan'] + dane[i][licz]['zmiana'] + '</b><br />' + dane[i][licz]['pojazd'] + '</s></button></td>');

                                    break;

                                case "5":
                                case "8":

                                    line.append('<td class="' + klasy + '" style="vertical-align: middle; ' + zmienne + '"><button type="button" class="btn btn-info btn-lg" onClick="PodgladKursu(' + dane[i][licz]['id'] + ');"><b><s>' + dane[i][licz]['plan'] + dane[i][licz]['zmiana'] + '</b><br />' + dane[i][licz]['pojazd'] + '</s></button></td>');

                                    break;

                                case "6":

                                    line.append('<td class="' + klasy + '" style="vertical-align: middle; ' + zmienne + '"><button type="button" class="btn btn-danger btn-lg" onClick="PodgladKursu(' + dane[i][licz]['id'] + ');"><b>' + dane[i][licz]['plan'] + dane[i][licz]['zmiana'] + '</b><br />' + dane[i][licz]['pojazd'] + '</button></td>');

                                    break;

                                default:

                                    if (dane[i][licz]['uzupelniony'] === "1") line.append('<td class="' + klasy + '" style="vertical-align: middle; ' + zmienne + '"><button type="button" class="btn btn-primary btn-lg" onClick="PodgladKursu(' + dane[i][licz]['id'] + ');"><b>' + dane[i][licz]['plan'] + dane[i][licz]['zmiana'] + '</b><br />' + dane[i][licz]['pojazd'] + '</button></td>');
                                    else line.append('<td class="' + klasy + '" style="vertical-align: middle; ' + zmienne + '"><button disabled type="button" class="btn btn-success btn-lg" onClick=""><i class="fas fa-question" style="color: white;"></i></button></td>');

                                    break;

                            }



                        }

                        $('#tabela2').append(line);
                    }




                    $.get("json/dyspozytornia_generowania.php?przesuniecie=" + id, function (data) {

                        var dane = JSON.parse(data);

                        $.each(dane, function () {

                            $("#tresc2").append("Grafik wygenerowany <b>" + this.kiedy + "</b> przez <b>" + this.wygenerowal + "</b> dla <b>" + this.kierowcow + "</b> kierowców.");

                        });

                        document.getElementById("loading").style.display = "none";
                        document.getElementById("tresc").style.display = "block";
                        document.getElementById("tresc2").style.display = "block";


                    });

                });


            });

        });



    });



}


$(document).ready(function () {

    Grafik(0);

});

$(window).resize(function () {
    if ($(window).width() > 1260) {
        $("#tabela").css("display", "table")
        $("#tabelaMobile").css("display", "none")
    }
    else {
        $("#tabela").css("display", "none")
        $("#tabelaMobile").css("display", "table")
    }

});