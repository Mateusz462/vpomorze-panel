function Ostrzezenie() {

    $("#modal-generuj").modal("show");

    $("#modal-generuj-przycisk").prop('disabled', false);

    $.get("json/grafik_dni.php?przesuniecie=1", function (data) {

        var dane = JSON.parse(data);

        let licz = 1;

        $.each(dane, function () {

            let zmienne = '';

            $("#modal-generuj-" + licz + " option[value='2']").remove();

            if (this.swieto === "1") {

                zmienne += 'color: #c00;';

                $("#modal-generuj-" + licz + " option[value='2']").remove();
                $("#modal-generuj-" + licz).append('<option value="2">Dzień świąteczny (chętni - KzW)</option>')

            } else {

                if (licz != 6) $("#modal-generuj-" + licz).append('<option value="2">Dzień wolny (możliwość KzW)</option>')



            }

            $('#data' + licz).html('<a style="' + zmienne + '">' + this.dzien + ' (' + this.data + ')</a>');

            licz++;

        });

        $("#modal-generuj-loading").css("display", "none");
        $("#modal-generuj-zawartosc").css("display", "block");


    });

}

function Generuj() {

    $("#modal-generuj-loading").css("display", "block");
    $("#modal-generuj-zawartosc").css("display", "none");

    $("#modal-generuj-przycisk").prop('disabled', true);

    function encodeQueryData(data) {

        let ret = [];
        for (let d in data)
            ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
        return ret.join('&');

    }

    var datalogin = encodeQueryData({

        'dzien1': $("#modal-generuj-1").val(),
        'dzien2': $("#modal-generuj-2").val(),
        'dzien3': $("#modal-generuj-3").val(),
        'dzien4': $("#modal-generuj-4").val(),
        'dzien5': $("#modal-generuj-5").val(),
        'dzien6': $("#modal-generuj-6").val(),
        'dzien7': $("#modal-generuj-7").val()

    });

    $.ajax({

        type: 'POST',
        data: datalogin,
        url: 'scripts/dyspozytornia_generuj.php',
        success: function (responseText) {

            if (responseText == 0) {

                Grafik(1);

                $("#modal-generuj").modal("hide");

                toastr.success('Sukces! Poprawnie wygenerowano grafik.');


            } else if (responseText == 1) {

                Grafik(1);

                $("#modal-generuj").modal("hide");

                toastr.error('Błąd! Nie udało się wygenerować grafiku.');

            }

        }


    });

}

function DodajKurs(id) {

    $('#modal-dodawanie-ostatnie').html("")

    $("#modal-dodawanie-loading").css("display", "block");
    $("#modal-dodawanie-zawartosc").css("display", "none");

    $("#modal-dodawanie-przycisk").prop('disabled', true);

    $("#modal-dodawanie").modal("show");

    $('#modal-dodawanie-plan').empty();
    $('#modal-dodawanie-plan').append(new Option("Wybierz..", 0));

    $('#modal-dodawanie-pojazd').empty();
    $('#modal-dodawanie-pojazd').append(new Option("Wybierz..", 0));

    $("#modal-dodawanie-pojazd-row").css("display", "none");

    $('#modal-dodawanie-uwagi').val("");

    $('#modal-dodawanie-przycisk').val(id);

    $.get("json/dyspozytornia_kurs.php?id=" + id, function (data) {

        var dane = JSON.parse(data);

        $.each(dane, function () {

            stalka = this.stalka_id;

            $('#modal-dodawanie-user').html(this.user);

            $('#modal-dodawanie-data').html(this.dzien + " (" + this.data + ")");

            $('#modal-dodawanie-typ').html("KURS GRAFIKOWY");

            if (this.stalka == 0) {

                $("#modal-dodawanie-opcja11").css("display", "none");
                $('#modal-dodawanie-stalka').html("-");
                checkbox = 0;

            } else {

                $("#modal-dodawanie-opcja11").css("display", "block");
                $('#modal-dodawanie-stalka').html(this.stalka);
                $('#opcja11').prop('checked', true);
                checkbox = 1;
            }

            checkbox2 = 1;
            $('#opcja22').prop('checked', true);

            google.charts.load('current', { packages: ['corechart', 'bar'] });
            google.charts.setOnLoadCallback(() => {

                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Plan');
                data.addColumn('number', 'Ilość przydzieleń');
                data.addRows(this.wykres);

                var options = {
                    animation: { startup: true, duration: 1000, easing: 'inAndOut' },
                    title: 'Najczęściej przydzielane ' + this.user_plain + ' (30 ostatnich dni)',
                    legend: 'none',
                    hAxis: {
                        title: 'Plany'
                    },
                    vAxis: {
                        title: 'Przydzieleń'
                    }
                };

                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            });

            let ostatnie = $('<ul>')
            this.ostatnio.forEach(element => {
                let lin = $('<li>').html(element.data + " " + element.zmiana + " " + element.pojazd)
                ostatnie.append(lin)
            });
            $('#modal-dodawanie-ostatnie').append(ostatnie)

            $.get("json/dyspozytornia_dostepne.php?id=" + id + "&checkbox=" + checkbox + "&checkbox2=" + checkbox2, function (data) {

                var dane = JSON.parse(data);

                $.each(dane, function () {

                    $('#modal-dodawanie-plan').append(new Option(this.nazwa + this.zmiana + " (" + this.godzina_od + " - " + this.godzina_do + ")", this.id));

                    $('#modal-dodawanie-plan').val(0);


                });

                $("#modal-dodawanie-loading").css("display", "none");
                $("#modal-dodawanie-zawartosc").css("display", "block");

            });

        });

    });



}

function DZasady() {

    $("#modal-dodawanie-pojazd-row").css("display", "none");
    $("#modal-dodawanie-plan-row").css("display", "none");

    $("#modal-dodawanie-loading-row").css("display", "block");

    $('#modal-dodawanie-plan').empty();
    $('#modal-dodawanie-plan').append(new Option("Wybierz..", 0));

    let id = $("#modal-dodawanie-przycisk").val();

    if ($('#opcja22').prop('checked') === true) checkbox2 = 1;
    else checkbox2 = 0;

    $.get("json/dyspozytornia_dostepne.php?id=" + id + "&checkbox=" + checkbox + "&checkbox2=" + checkbox2, function (data) {

        var dane = JSON.parse(data);

        $.each(dane, function () {

            $('#modal-dodawanie-plan').append(new Option(this.nazwa + this.zmiana + " (" + this.godzina_od + " - " + this.godzina_do + ")", this.id));

            $('#modal-dodawanie-plan').val(0);


        });

        $("#modal-dodawanie-plan-row").css("display", "block");

        $("#modal-dodawanie-loading-row").css("display", "none");

    });



}

function DStalka() {

    $("#modal-dodawanie-pojazd-row").css("display", "none");
    $("#modal-dodawanie-plan-row").css("display", "none");

    $("#modal-dodawanie-loading-row").css("display", "block");

    $('#modal-dodawanie-plan').empty();
    $('#modal-dodawanie-plan').append(new Option("Wybierz..", 0));

    let id = $("#modal-dodawanie-przycisk").val();

    if ($('#opcja11').prop('checked') === true) checkbox = 1;
    else checkbox = 0;

    $.get("json/dyspozytornia_dostepne.php?id=" + id + "&checkbox=" + checkbox + "&checkbox2=" + checkbox2, function (data) {

        var dane = JSON.parse(data);

        $.each(dane, function () {

            $('#modal-dodawanie-plan').append(new Option(this.nazwa + this.zmiana + " (" + this.godzina_od + " - " + this.godzina_do + ")", this.id));

            $('#modal-dodawanie-plan').val(0);


        });

        $("#modal-dodawanie-plan-row").css("display", "block");

        $("#modal-dodawanie-loading-row").css("display", "none");

    });



}

function DObslugaPlanu() {

    let kontroler = $("#modal-dodawanie-plan");

    if (kontroler.val() == 0) {

        $("#modal-dodawanie-przycisk").prop('disabled', true);
        $("#modal-dodawanie-pojazd-row").css("display", "none");

    }

    if (kontroler.val() != 0) {

        let plan = kontroler.val();
        let id = $("#modal-dodawanie-przycisk").val();

        $("#modal-dodawanie-pojazd-row").css("display", "none");
        $("#modal-dodawanie-loading-row").css("display", "block");

        $('#modal-dodawanie-pojazd').empty();
        $('#modal-dodawanie-pojazd').append(new Option("Wybierz..", 0));

        $.get("json/dyspozytornia_dostepne.php?id=" + id + "&checkbox=" + checkbox + "&plan=" + plan + "&checkbox2=" + checkbox2, function (data) {

            var dane = JSON.parse(data);

            $.each(dane, function () {

                if (this.zgodny == 1) {

                    if (this.id == stalka) {

                        //inny wóz jest stałką
                        $('#modal-dodawanie-pojazd').append(new Option(this.marka + " " + this.model + " #" + this.nr_tab + "  [stały przydział] [+]", this.id));

                    } else {

                        $('#modal-dodawanie-pojazd').append(new Option(this.marka + " " + this.model + " #" + this.nr_tab + "  [+]", this.id));

                    }

                } else {

                    if (this.id == stalka) {

                        //inny wóz jest stałką
                        $('#modal-dodawanie-pojazd').append(new Option(this.marka + " " + this.model + " #" + this.nr_tab + "  [stały przydział]", this.id));

                    } else {

                        $('#modal-dodawanie-pojazd').append(new Option(this.marka + " " + this.model + " #" + this.nr_tab, this.id));

                    }

                }

                $('#modal-dodawanie-pojazd').val(0);

                if (this.wymuszony != 0) {

                    $("#modal-dodawanie-wymuszanie").css("display", "block");
                    $("#modal-dodawanie-wymuszanie").html("Pojazd wymuszony ze zmiany: <b>" + this.wymuszony + "</b>.");

                } else {

                    $("#modal-dodawanie-wymuszanie").css("display", "none");

                }


            });

            $("#modal-dodawanie-pojazd-row").css("display", "block");
            $("#modal-dodawanie-loading-row").css("display", "none");

        });

    }

}

function DObslugaPojazdu() {

    let kontroler = $("#modal-dodawanie-pojazd");

    if (kontroler.val() == 0) $("#modal-dodawanie-przycisk").prop('disabled', true);
    else $("#modal-dodawanie-przycisk").prop('disabled', false);


}

function ZapiszDodawanie() {

    window.restoreSession()

    $("#modal-dodawanie-loading").css("display", "block");
    $("#modal-dodawanie-zawartosc").css("display", "none");

    $("#modal-dodawanie-przycisk").prop('disabled', true);

    function encodeQueryData(data) {

        let ret = [];
        for (let d in data)
            ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
        return ret.join('&');

    }

    var datalogin = encodeQueryData({
        'id': $("#modal-dodawanie-przycisk").val(),
        'plan': $("#modal-dodawanie-plan").val(),
        'pojazd': $("#modal-dodawanie-pojazd").val(),
        'uwaga': $("#modal-dodawanie-uwagi").val(),
        'checkbox': checkbox,
        'checkbox2': checkbox,
        'edycja': 0
    });


    $.ajax({

        type: 'POST',
        data: datalogin,
        url: 'scripts/nowa_dyspozytornia.php',
        success: function (responseText) {

            if (responseText == 0) {

                $("#modal-dodawanie").modal("hide");

                Grafik(GRAFIK);

                toastr.success('Sukces! Poprawnie dodano kurs.');


            } else if (responseText == 1) {

                $("#modal-dodawanie").modal("hide");

                Grafik(GRAFIK);

                toastr.error('Błąd! Nie udało się dodać kursu.');

            }

        }

    });

}

let czyStalka;
let checkbox;
let stalka;
let GRAFIK;
let checkbox2;

function PodgladKursu(id) {

    $('#modal-podglad-ostatnie').html("")

    $("#chart_div_edycja").css("display", "none");
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
    $("#modal-podglad-wpisujacy-row").css("display", "block");

    $.get("json/dyspozytornia_podglad.php?id=" + id, function (data) {

        var dane = JSON.parse(data);
        console.log(dane)

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

            //$("#modal-podglad-wpisujacy").html(this.wpisujacy);
            let lu = $('<ol>')
            this.historia.forEach((elem) => {
                let li = $('<li>')

                switch (elem.akcja) {
                    case "13":
                        li.html(elem.wpisujacy + " zgłosił rezerwę. Sygnatura czasowa: " + elem.data_wpisania)
                        break;
                    case "33":
                        li.html(elem.wpisujacy + " złożył raport. Sygnatura czasowa: " + elem.data_wpisania)
                        break;
                    case "39":
                        li.html(elem.wpisujacy + " wziął kurs z wolnego. Sygnatura czasowa: " + elem.data_wpisania)
                        break;
                    case "41":
                        li.html(elem.wpisujacy + " wpisał służbę. Sygnatura czasowa: " + elem.data_wpisania)
                        break;
                    case "42":
                        li.html(elem.wpisujacy + " edytował służbę. Sygnatura czasowa: " + elem.data_wpisania)
                        break;
                    case "46":
                        li.html(elem.wpisujacy + " zezwolił na opóźnione złożenie raportu. Sygnatura czasowa: " + elem.data_wpisania)
                        break;
                    case "47":
                        li.html(elem.wpisujacy + " wycofał zezwolenie na opóźnione złożenie raportu. Sygnatura czasowa: " + elem.data_wpisania)
                        break;
                    case "48":
                        li.html(elem.wpisujacy + " usprawiedliwił niewykonaną służbę. Sygnatura czasowa: " + elem.data_wpisania)
                        break;
                    case "49":
                        li.html(elem.wpisujacy + " wycofał usprawiedliwienie niewykonanej służby. Sygnatura czasowa: " + elem.data_wpisania)
                        break;
                }


                lu.append(li)
            })
            $("#modal-podglad-wpisujacy").html(lu)

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

            let ostatnie = $('<ul>')
            this.ostatnio.forEach(element => {
                let lin = $('<li>').html(element.data + " " + element.zmiana + " " + element.pojazd)
                ostatnie.append(lin)
            });
            $('#modal-podglad-ostatnie').append(ostatnie)

            $("#modal-podglad-uwagi").html(this.uwaga);
            $("#modal-edycja-uwagi").val(this.uwaga);

            $("#modal-usuwanie-przycisk").val(this.id);

        });

        $("#modal-podglad-loading").css("display", "none");
        $("#modal-podglad-zawartosc").css("display", "block");


    });

}

function ZapiszEdycje() {

    window.restoreSession()

    $("#modal-podglad-loading").css("display", "block");
    $("#modal-podglad-zawartosc").css("display", "none");

    $("#modal-zapisywanie-przycisk").prop('disabled', true);

    function encodeQueryData(data) {

        let ret = [];
        for (let d in data)
            ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
        return ret.join('&');

    }

    var datalogin = encodeQueryData({
        'id': $("#modal-usuwanie-przycisk").val(),
        'plan': $("#modal-edycja-plan").val(),
        'pojazd': $("#modal-edycja-pojazd").val(),
        'uwaga': $("#modal-edycja-uwagi").val(),
        'checkbox': checkbox,
        'checkbox2': checkbox,
        'edycja': 1
    });


    $.ajax({

        type: 'POST',
        data: datalogin,
        url: 'scripts/nowa_dyspozytornia.php',
        success: function (responseText) {

            if (responseText == 0) {

                $("#modal-podglad").modal("hide");

                toastr.success('Sukces! Poprawnie zmieniono kurs.');

                Grafik(GRAFIK);


            } else if (responseText == 1) {

                $("#modal-podglad").modal("hide");

                toastr.error('Błąd! Nie udało się zmienić kursu.');

                Grafik(GRAFIK);

            }

        }

    });

}

function EdytujKurs() {

    $("#chart_div_edycja").css("display", "block");
    $("#modal-podglad-loading").css("display", "block");
    $("#modal-podglad-zawartosc").css("display", "none");


    //podmiana klasowa
    $(".podglad").css("display", "none");
    $(".edycja").css("display", "block");

    $("#modal-edycja-opcje-row").css("display", "block");

    if (czyStalka === 1) $("#modal-edycja-opcja1").css("display", "block");
    else $("#modal-edycja-opcja1").css("display", "none");

    if (checkbox === 1) $('#opcja1').prop('checked', true);
    else $('#opcja1').prop('checked', false);

    if (checkbox2 === 1) $('#opcja2').prop('checked', true);
    else $('#opcja2').prop('checked', false);


    //ustawienie przycisków
    $("#modal-edycja-przycisk").css("display", "none");
    $("#modal-usuwanie-przycisk").css("display", "none");
    $("#modal-zapisywanie-przycisk").css("display", "block");

    $("#modal-edycja-wymuszanie").css("display", "none");

    $('#modal-edycja-plan').empty();
    $('#modal-edycja-plan').append(new Option("Wybierz..", 0));

    $('#modal-edycja-pojazd').empty();
    $('#modal-edycja-pojazd').append(new Option("Wybierz..", 0));

    $("#modal-edycja-pojazd-row").css("display", "block");
    $("#modal-edycja-plan-row").css("display", "block");

    $("#modal-edycja-loading-row").css("display", "none");
    $("#modal-podglad-wpisujacy-row").css("display", "none");

    let id = $("#modal-usuwanie-przycisk").val();
    let plan = $("#modal-podglad-plan-id").val();

    $.get("json/dyspozytornia_kurs.php?id=" + id, function (data) {

        var dane = JSON.parse(data);

        $.each(dane, function () {

            google.charts.load('current', { packages: ['corechart'] });
            google.charts.setOnLoadCallback(() => {

                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Plan');
                data.addColumn('number', 'Ilość przydzieleń');
                data.addRows(this.wykres);

                var options = {
                    animation: { startup: true, duration: 1000, easing: 'inAndOut' },
                    title: 'Najczęściej przydzielane ' + this.user_plain + ' (30 ostatnich dni)',
                    legend: 'none',
                    hAxis: {
                        title: 'Plany'
                    },
                    vAxis: {
                        title: 'Przydzieleń'
                    }
                };

                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_edycja'));
                chart.draw(data, options);
            });

        });

    });

    $.get("json/dyspozytornia_dostepne.php?id=" + id + "&checkbox=" + checkbox + "&checkbox2=" + checkbox2, function (data) {

        var dane = JSON.parse(data);

        $.each(dane, function () {


            if (this.id == $("#modal-podglad-plan-id").val()) $('#modal-edycja-plan').append(new Option(this.nazwa + this.zmiana + " (" + this.godzina_od + " - " + this.godzina_do + ") [aktualny]", this.id));
            else $('#modal-edycja-plan').append(new Option(this.nazwa + this.zmiana + " (" + this.godzina_od + " - " + this.godzina_do + ")", this.id));

            $('#modal-edycja-plan').val($("#modal-podglad-plan-id").val());


        });

        $.get("json/dyspozytornia_dostepne.php?id=" + id + "&checkbox=" + checkbox + "&plan=" + plan + "&checkbox2=" + checkbox2, function (data) {

            var dane = JSON.parse(data);

            $.each(dane, function () {

                if (this.zgodny == 1) {

                    if (this.id == $("#modal-podglad-pojazd-id").val() && this.id != stalka) {

                        //aktualny wóz nie jest stałką
                        $('#modal-edycja-pojazd').append(new Option(this.marka + " " + this.model + " #" + this.nr_tab + "  [aktualny] [+]", this.id));

                    } else if (this.id == $("#modal-podglad-pojazd-id").val() && this.id == stalka) {

                        //aktualny wóz jest stałką
                        $('#modal-edycja-pojazd').append(new Option(this.marka + " " + this.model + " #" + this.nr_tab + "  [aktualny] [stały przydział] [+]", this.id));

                    } else if (this.id != $("#modal-podglad-pojazd-id").val() && this.id == stalka) {

                        //inny wóz jest stałką
                        $('#modal-edycja-pojazd').append(new Option(this.marka + " " + this.model + " #" + this.nr_tab + "  [stały przydział] [+]", this.id));

                    } else {

                        $('#modal-edycja-pojazd').append(new Option(this.marka + " " + this.model + " #" + this.nr_tab + "  [+]", this.id));

                    }

                } else {

                    if (this.id == $("#modal-podglad-pojazd-id").val() && this.id != stalka) {

                        //aktualny wóz nie jest stałką
                        $('#modal-edycja-pojazd').append(new Option(this.marka + " " + this.model + " #" + this.nr_tab + "  [aktualny]", this.id));

                    } else if (this.id == $("#modal-podglad-pojazd-id").val() && this.id == stalka) {

                        //aktualny wóz jest stałką
                        $('#modal-edycja-pojazd').append(new Option(this.marka + " " + this.model + " #" + this.nr_tab + "  [aktualny] [stały przydział]", this.id));

                    } else if (this.id != $("#modal-podglad-pojazd-id").val() && this.id == stalka) {

                        //inny wóz jest stałką
                        $('#modal-edycja-pojazd').append(new Option(this.marka + " " + this.model + " #" + this.nr_tab + "  [stały przydział]", this.id));

                    } else {

                        $('#modal-edycja-pojazd').append(new Option(this.marka + " " + this.model + " #" + this.nr_tab, this.id));

                    }

                }


                $('#modal-edycja-pojazd').val($("#modal-podglad-pojazd-id").val());

                if (this.wymuszony != 0) {

                    $("#modal-edycja-wymuszanie").css("display", "block");
                    $("#modal-edycja-wymuszanie").html("Pojazd wymuszony ze zmiany: " + this.wymuszony);

                } else {

                    $("#modal-edycja-wymuszanie").css("display", "none");

                }


            });

            $("#modal-podglad-loading").css("display", "none");
            $("#modal-podglad-zawartosc").css("display", "block");
            $("#modal-zapisywanie-przycisk").prop('disabled', false);

        });

    });

}

function ObslugaPlanu() {

    let kontroler = $("#modal-edycja-plan");

    if (kontroler.val() == 0) {

        $("#modal-zapisywanie-przycisk").prop('disabled', true);
        $("#modal-edycja-pojazd-row").css("display", "none");

    }

    if (kontroler.val() != 0) {

        let plan = kontroler.val();
        let id = $("#modal-usuwanie-przycisk").val();

        $("#modal-edycja-pojazd-row").css("display", "none");
        $("#modal-edycja-loading-row").css("display", "block");

        $('#modal-edycja-pojazd').empty();
        $('#modal-edycja-pojazd').append(new Option("Wybierz..", 0));

        $.get("json/dyspozytornia_dostepne.php?id=" + id + "&checkbox=" + checkbox + "&plan=" + plan + "&checkbox2=" + checkbox2, function (data) {

            var dane = JSON.parse(data);

            $.each(dane, function () {

                if (this.zgodny == 1) {

                    if (this.id == $("#modal-podglad-pojazd-id").val() && this.id != stalka) {

                        //aktualny wóz nie jest stałką
                        $('#modal-edycja-pojazd').append(new Option(this.marka + " " + this.model + " #" + this.nr_tab + "  [aktualny] [+]", this.id));

                    } else if (this.id == $("#modal-podglad-pojazd-id").val() && this.id == stalka) {

                        //aktualny wóz jest stałką
                        $('#modal-edycja-pojazd').append(new Option(this.marka + " " + this.model + " #" + this.nr_tab + "  [aktualny] [stały przydział] [+]", this.id));

                    } else if (this.id != $("#modal-podglad-pojazd-id").val() && this.id == stalka) {

                        //inny wóz jest stałką
                        $('#modal-edycja-pojazd').append(new Option(this.marka + " " + this.model + " #" + this.nr_tab + "  [stały przydział] [+]", this.id));

                    } else {

                        $('#modal-edycja-pojazd').append(new Option(this.marka + " " + this.model + " #" + this.nr_tab + "  [+]", this.id));

                    }

                } else {

                    if (this.id == $("#modal-podglad-pojazd-id").val() && this.id != stalka) {

                        //aktualny wóz nie jest stałką
                        $('#modal-edycja-pojazd').append(new Option(this.marka + " " + this.model + " #" + this.nr_tab + "  [aktualny]", this.id));

                    } else if (this.id == $("#modal-podglad-pojazd-id").val() && this.id == stalka) {

                        //aktualny wóz jest stałką
                        $('#modal-edycja-pojazd').append(new Option(this.marka + " " + this.model + " #" + this.nr_tab + "  [aktualny] [stały przydział]", this.id));

                    } else if (this.id != $("#modal-podglad-pojazd-id").val() && this.id == stalka) {

                        //inny wóz jest stałką
                        $('#modal-edycja-pojazd').append(new Option(this.marka + " " + this.model + " #" + this.nr_tab + "  [stały przydział]", this.id));

                    } else {

                        $('#modal-edycja-pojazd').append(new Option(this.marka + " " + this.model + " #" + this.nr_tab, this.id));

                    }

                }
                $('#modal-edycja-pojazd').val(0);

                if (this.wymuszony != 0) {

                    $("#modal-edycja-wymuszanie").css("display", "block");
                    $("#modal-edycja-wymuszanie").html("Pojazd wymuszony ze zmiany: <b>" + this.wymuszony + "</b>.");

                } else {

                    $("#modal-edycja-wymuszanie").css("display", "none");

                }


            });

            $("#modal-edycja-pojazd-row").css("display", "block");
            $("#modal-edycja-loading-row").css("display", "none");

        });

    }

}

function ObslugaPojazdu() {

    let kontroler = $("#modal-edycja-pojazd");

    if (kontroler.val() == 0) $("#modal-zapisywanie-przycisk").prop('disabled', true);
    else $("#modal-zapisywanie-przycisk").prop('disabled', false);


}

function Zasady() {

    $("#modal-edycja-pojazd-row").css("display", "none");
    $("#modal-edycja-plan-row").css("display", "none");

    $("#modal-edycja-loading-row").css("display", "block");

    $('#modal-edycja-plan').empty();
    $('#modal-edycja-plan').append(new Option("Wybierz..", 0));

    let id = $("#modal-usuwanie-przycisk").val();

    if ($('#opcja2').prop('checked') === true) checkbox2 = 1;
    else checkbox2 = 0;

    $.get("json/dyspozytornia_dostepne.php?id=" + id + "&checkbox=" + checkbox + "&checkbox2=" + checkbox2, function (data) {

        var dane = JSON.parse(data);

        $.each(dane, function () {

            if (this.id == $("#modal-podglad-plan-id").val()) $('#modal-edycja-plan').append(new Option(this.nazwa + this.zmiana + " (" + this.godzina_od + " - " + this.godzina_do + ") [aktualny]", this.id));
            else $('#modal-edycja-plan').append(new Option(this.nazwa + this.zmiana + " (" + this.godzina_od + " - " + this.godzina_do + ")", this.id));

            $('#modal-edycja-plan').val(0);


        });

        $("#modal-edycja-plan-row").css("display", "block");

        $("#modal-edycja-loading-row").css("display", "none");

    });



}

function Stalka() {

    $("#modal-edycja-pojazd-row").css("display", "none");
    $("#modal-edycja-plan-row").css("display", "none");

    $("#modal-edycja-loading-row").css("display", "block");

    $('#modal-edycja-plan').empty();
    $('#modal-edycja-plan').append(new Option("Wybierz..", 0));

    let id = $("#modal-usuwanie-przycisk").val();

    if ($('#opcja1').prop('checked') === true) checkbox = 1;
    else checkbox = 0;

    $.get("json/dyspozytornia_dostepne.php?id=" + id + "&checkbox=" + checkbox + "&checkbox2=" + checkbox2, function (data) {

        var dane = JSON.parse(data);

        $.each(dane, function () {

            if (this.id == $("#modal-podglad-plan-id").val()) $('#modal-edycja-plan').append(new Option(this.nazwa + this.zmiana + " (" + this.godzina_od + " - " + this.godzina_do + ") [aktualny]", this.id));
            else $('#modal-edycja-plan').append(new Option(this.nazwa + this.zmiana + " (" + this.godzina_od + " - " + this.godzina_do + ")", this.id));

            $('#modal-edycja-plan').val(0);


        });

        $("#modal-edycja-plan-row").css("display", "block");

        $("#modal-edycja-loading-row").css("display", "none");

    });



}

function UsunKurs() {

    $("#modal-podglad-loading").css("display", "block");
    $("#modal-podglad-zawartosc").css("display", "none");

    $("#modal-edycja-przycisk").prop('disabled', true);
    $("#modal-usuwanie-przycisk").prop('disabled', true);

    function encodeQueryData(data) {

        let ret = [];
        for (let d in data)
            ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
        return ret.join('&');

    }

    var datalogin = encodeQueryData({
        'id': $("#modal-usuwanie-przycisk").val()
    });

    $.ajax({

        type: 'POST',
        data: datalogin,
        url: 'scripts/usun_dyspozytornia.php',
        success: function (responseText) {

            if (responseText == 0) {

                Grafik(GRAFIK);

                $("#modal-podglad").modal("hide");

                toastr.success('Sukces! Poprawnie usunięto kurs.');

            } else if (responseText == 1) {

                //nie udalo sie usunac, jakis blad

                Grafik(GRAFIK);

                $("#modal-podglad").modal("hide");

                toastr.error('Błąd! Nie udało się usunąć kursu.');

            }

        }

    });


}

function Grafik(id) {

    GRAFIK = id;

    document.getElementById("loading").style.display = "block";
    document.getElementById("tresc").style.display = "none";
    document.getElementById("tresc2").style.display = "none";

    $.get("json/dyspozytornia_zakres.php?przesuniecie=" + id, function (data) {

        var dane = JSON.parse(data);

        $.each(dane, function () {


            if (this.cofanie == 1) $("#tresc").html('<button type="button" onclick="Grafik(' + (id - 1) + ')" class="btn btn-success btn-lg"><i class="fa fa-arrow-left" style="color: white;"></i></button>');
            else $("#tresc").html('<button type="button" disabled class="btn btn-danger btn-lg"><i class="fas fa-times" style="color: white;"></i></button>');

            $("#tresc").append('<button type="button" class="btn btn-light btn-lg" disabled=""><div id="nazwa">GRAFIK NA TYDZIEŃ <b>' + this.zakres + '</b></div></button>');

            if (this.przod == 1) $("#tresc").append('<button type="button" onclick="Grafik(' + (id + 1) + ');" class="btn btn-success btn-lg"><i class="fa fa-arrow-right" style="color: white;"></i></button>');
            else $("#tresc").append('<button type="button" disabled class="btn btn-danger btn-lg"><i class="fas fa-times" style="color: white;"></i></button>');

            if (this.grafik == 1) {

                $.get("json/grafik_dni.php?przesuniecie=" + id, function (data) {

                    var dane = JSON.parse(data);

                    $("#tresc2").html('<br /><br /><div class="table-responsive"><table id="tabela" class="table table-bordered" style="width: calc(100% - 1px);  overflow-x:hidden;"></table></div>');

                    let line = $('<tr>');

                    line.append('<th scope="col" style="width: calc(100%/8)" class="align-middle">KIEROWCA<BR />NR SŁUŻBOWY<BR />STAŁY PRZYDZIAŁ</th>');

                    $.each(dane, function (index) {
                        let zmienne = 'width: calc(100%/8);';
                        let klasy = '';
                        if (this.swieto === "1") zmienne += 'color: #c00;';
                        if (this.dzis === "1") klasy += 'grafikDzis ';

                        let dymek = "<div class='spinner-border spinner-border-sm' role='status'>  <span class='sr-only'>Loading...</span>  </div>"

                        line.append('<th scope="col" class="' + klasy + '" style="' + zmienne + '">' + this.dzien + '<BR /> '
                            + this.data + '<BR /><i id=\"dymek_' + index + '\" class="fas fa-question-circle" rel="tooltip" data-html="true" title="' + dymek + '"></i><BR />\
                            <button class="btn btn-sm ' + (this.uwagi ? 'btn-danger' : 'btn-info') + '" onClick="uwagaDyspo(\'' + this.uwagi.replaceAll("\n", "\\n") + '\', \'' + this.data + '\')">\
                            <i class="fas ' + (this.uwagi ? 'fa-exclamation-triangle' : 'fa-question-circle') + '"></i>\
                            </button></th>');


                        let didhappen = false

                        $("#tresc2").on('shown.bs.tooltip', '#dymek_' + index, function () {
                            if (!didhappen) {

                                $.get("json/grafik_dymki.php?przesuniecie=" + id + "&index=" + index, function (data) {
                                    var dane = JSON.parse(data);
                                    $("#dymek_" + index).attr('data-original-title', dane).tooltip({ placement: 'bottom', html: true, container: '#tresc2' }).tooltip('show');
                                    didhappen = true
                                });
                            }
                        });
                    });

                    $('#tabela').append(line);
                    $('[rel=tooltip]').tooltip({ placement: 'bottom', html: true, container: '#tresc2' });

                    $.get("json/dyspozytornia_grafik.php?przesuniecie=" + id, function (data) {

                        var dane = JSON.parse(data);

                        var i;

                        for (i = 0; i < dane.length; i++) {

                            let line = $('<tr>');

                            line.append('<td style="vertical-align: middle;"><b>' + dane[i][0]['kierowca'] + '</b><br /><small>' + dane[i][0]['nr_sluzbowy'] + (dane[i][0]['stalka'] != null ? ('<br />' + dane[i][0]['stalka'] + '</small></td>') : '</small></td>'));

                            var licz;

                            for (licz = 1; licz <= 7; licz++) {

                                let klasy = '';


                                if (dane[i][licz]['dzis'] === "1") klasy += 'grafikDzis ';

                                switch (dane[i][licz]['typ']) {


                                    case "7":

                                        line.append('<td style="vertical-align: middle;" class="' + klasy + '"><b>' + dane[i][licz]['wolne'] + '</b></td>');

                                        break;

                                    case "4":

                                        line.append('<td style="vertical-align: middle;" class="' + klasy + '"><b style="color: orange;">' + dane[i][licz]['wolne'] + '</b></td>');

                                        break;

                                    case "2":

                                        line.append('<td style="vertical-align: middle;" class="' + klasy + '"><button type="button" class="btn btn-warning btn-lg" onClick="PodgladKursu(' + dane[i][licz]['id'] + ');"><b>' + dane[i][licz]['plan'] + dane[i][licz]['zmiana'] + '</b><br />' + dane[i][licz]['pojazd'] + '</button></td>');

                                        break;

                                    case "3":

                                        line.append('<td style="vertical-align: middle;" class="' + klasy + '"><button type="button" class="btn btn-danger btn-lg" onClick="PodgladKursu(' + dane[i][licz]['id'] + ');"><b><s>' + dane[i][licz]['plan'] + dane[i][licz]['zmiana'] + '</b><br />' + dane[i][licz]['pojazd'] + '</s></button></td>');

                                        break;

                                    case "5":
                                    case "8":

                                        line.append('<td style="vertical-align: middle;" class="' + klasy + '"><button type="button" class="btn btn-info btn-lg" onClick="PodgladKursu(' + dane[i][licz]['id'] + ');"><b><s>' + dane[i][licz]['plan'] + dane[i][licz]['zmiana'] + '</b><br />' + dane[i][licz]['pojazd'] + '</s></button></td>');

                                        break;

                                    case "6":

                                        line.append('<td style="vertical-align: middle;" class="' + klasy + '"><button type="button" class="btn btn-danger btn-lg" onClick="PodgladKursu(' + dane[i][licz]['id'] + ');"><b>' + dane[i][licz]['plan'] + dane[i][licz]['zmiana'] + '</b><br />' + dane[i][licz]['pojazd'] + '</button></td>');

                                        break;

                                    default:

                                        let edytowalny = '';

                                        if (dane[i][licz]['edytowalny'] === "0") edytowalny += 'disabled';

                                        if (dane[i][licz]['uzupelniony'] === "1") line.append('<td style="vertical-align: middle;" class="' + klasy + '"><button type="button" class="btn btn-primary btn-lg" onClick="PodgladKursu(' + dane[i][licz]['id'] + ');"><b>' + dane[i][licz]['plan'] + dane[i][licz]['zmiana'] + '</b><br />' + dane[i][licz]['pojazd'] + '</button></td>');
                                        else line.append('<td style="vertical-align: middle;" class="' + klasy + '"><button ' + edytowalny + ' type="button" class="btn btn-success btn-lg" onClick="DodajKurs(' + dane[i][licz]['id'] + ');"><i class="fas fa-plus" style="color: white;"></i></button></td>');

                                        break;

                                }



                            }

                            $('#tabela').append(line);
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

            } else {

                $("#tresc2").html('<br /><br /><button type="button" onClick="Ostrzezenie();" class="btn btn-info btn-lg"><i class="fas fa-plus" style="color: white;"></i>  &nbsp;WYGENERUJ GRAFIK NA TEN TYDZIEŃ</button><br /><br />');

                document.getElementById("loading").style.display = "none";
                document.getElementById("tresc").style.display = "block";
                document.getElementById("tresc2").style.display = "block";

            }

        });



    });


}

function uwagaDyspo(uwagi, dzien) {
    $("#modal-dyspozytora").modal("show");
    $("#modal-dyspozytora-loading").css("display", "block")
    $("#modal-dyspozytora-zawartosc").css("display", "none")
    $("#modal-dyspozytora-dzien").html(dzien)
    $("textarea#modal-dyspozytora-uwagi").val(uwagi)

    $("#modal-dyspozytora-loading").css("display", "none")
    $("#modal-dyspozytora-zawartosc").css("display", "block")
    $("#modal-dyspozytora-przycisk").css("display", "block")
}

function ZapiszUwageDyspo() {
    function encodeQueryData(data) {

        let ret = [];
        for (let d in data)
            ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
        return ret.join('&');

    }

    $("#modal-dyspozytora-loading").css("display", "block")
    $("#modal-dyspozytora-zawartosc").css("display", "none")
    $("#modal-dyspozytora-przycisk").css("display", "none")
    let uwagi = $("textarea#modal-dyspozytora-uwagi").val()
    let dzien = $("#modal-dyspozytora-dzien").html()
    dzien = dzien.split(".")
    dzien = new Date(dzien[2], dzien[1] - 1, dzien[0])
    dzien = dzien.getFullYear() + "-" + (dzien.getMonth() + 1) + "-" + dzien.getDate()

    var datalogin = encodeQueryData({
        'dzien': dzien,
        'uwagi': uwagi
    });

    $.ajax({

        type: 'POST',
        data: datalogin,
        url: 'scripts/dyspozytornia_uwaga.php',
        success: function (responseText) {

            if (responseText == 0) {
                Grafik(GRAFIK);

                $("#modal-dyspozytora").modal("hide");
                toastr.success('Sukces! Poprawnie dodano uwagę do graifku.');

            } else if (responseText == 1) {
                Grafik(GRAFIK);

                $("#modal-dyspozytora").modal("hide");
                toastr.error('Błąd! Nie udało się dodać uwagi.');

            }

        }


    });

}


$(document).ready(function () {

    Grafik(0);

});