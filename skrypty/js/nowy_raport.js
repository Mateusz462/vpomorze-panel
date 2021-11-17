function Badge() {

    $.get("json/raporty_badge.php", function (data) {

        var dane = JSON.parse(data);

        let licz = 1;

        $.each(dane, function () {

            $('#b' + licz++).html(this.ilosc);

        });

    });

}

function pad(value) {
    if (value < 10) {
        return '0' + value;
    } else {
        return value;
    }
}

function timeConverter(timestamp) {
    var a = new Date(timestamp);
    var months = ['Sty', 'Lut', 'Mar', 'Kwi', 'Maj', 'Cze', 'Lip', 'Sie', 'Wrz', 'PaĹş', 'Lis', 'Gru'];
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var date = a.getDate();
    var hour = pad(a.getHours());
    var min = pad(a.getMinutes());
    var sec = pad(a.getSeconds());
    var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec;
    return time;
}

function zmienStatystyke(typ) {

    if (typ == 1) {
        $('#btnStat1').prop('disabled', true);
        $('#btnStat2').prop('disabled', false);
        $('#btnStat1').removeClass('btn-primary').addClass('btn-secondary')
        $('#btnStat2').removeClass('btn-secondary').addClass('btn-primary')
        $('#modal-podglad-statystyka').html('<iframe class="embed-responsive-item" src="https://mzkp-strzelce.pl/panel/json/podskrypty/raport_statystyka.php?idr=' + $('#btnStat1').val() + '"></iframe>');
    }
    else if (typ == 2) {
        $('#btnStat1').prop('disabled', false);
        $('#btnStat2').prop('disabled', true);
        $('#btnStat1').removeClass('btn-secondary').addClass('btn-primary')
        $('#btnStat2').removeClass('btn-primary').addClass('btn-secondary')
        $('#modal-podglad-statystyka').html('<iframe class="embed-responsive-item" src="https://mzkp-strzelce.pl/panel/json/podskrypty/raport_statystyka_szczeg.php?idr=' + $('#btnStat1').val() + '"></iframe>');
    }
}

let galeria = [];
let linkizimgura = []

let settings = {
    "_type": "imgur",
    "url": "https://api.imgur.com/3/image",
    "method": "POST",
    "timeout": 0,
    "headers": {
        "Authorization": "Client-ID d531c71ea40ab45"
    },
    "processData": false,
    "mimeType": "multipart/form-data",
    "contentType": false,
    "data": null
};

async function toBinary(file) {
    return new Promise((resolve, reject) => {
        var reader = new FileReader();
        reader.onloadend = function () {
            resolve(reader.result)
        }
        reader.readAsDataURL(file)
    });
}

function PodgladRaport(id) {

    document.getElementById("modal-podglad-loading").style.display = "block";
    document.getElementById("modal-podglad-zawartosc").style.display = "none";

    $("#modal-podglad").modal("show");

    $("#modal-podglad-statystyka-row").css("display", "block");

    $.get("json/raporty_tabela3.php?id=" + id, function (data) {

        var dane = JSON.parse(data);

        $.each(dane, function () {

            $('#modal-podglad-ocena').html("");

            if (this.ocena === "1") document.getElementById("modal-podglad-ocena").innerHTML = '<div class="callout callout-' + this.kolor_oceny + '"><h5>RAPORT <b>' + this.nazwa_oceny + '</b></h5><p>' + this.komentarz + '<br /><br />Stawka godzinowa: <b>' + (this.stawka) + '</b> zĹ/h<br />ObsĹuĹźonych przystankĂłw: <b>' + (this.przystankow) + '</b><br />PunktualnoĹÄ: <b>' + Math.round(((this.punktualnosc) + Number.EPSILON) * 100) / 100 + '%</b><br />Czas pracy: <b>' + this.godziny_pracy + '</b> (' + this.czas_pracy + ' min.)<br /><br />Suma punktĂłw: <b>' + this.punkty + '</b> pkt.</p><small>Oceniono <b>' + this.sprawdzono + '</b> przez <b>' + this.user + '</b>.</small></div><hr />';

            if (this.ocena === "2") document.getElementById("modal-podglad-ocena").innerHTML = '<div class="callout callout-' + this.kolor_oceny + '"><h5>RAPORT <b>' + this.nazwa_oceny + '</b></h5><p>Raport zostaĹ warunkowo oceniony jako zaliczony, ale z powodu uchybieĹ nie przyznano punktĂłw.<br /><br />' + this.komentarz + '</p><small>Oceniono <b>' + this.sprawdzono + '</b> przez <b>' + this.user + '</b>.</small></div><hr />';

            if (this.ocena === "3") document.getElementById("modal-podglad-ocena").innerHTML = '<div class="callout callout-' + this.kolor_oceny + '"><h5>RAPORT <b>' + this.nazwa_oceny + '</b></h5><p>Raport zostaĹ niezaliczony z powodu powaĹźnych uchybieĹ.<br /><br />' + this.komentarz + '</p><small>Oceniono <b>' + this.sprawdzono + '</b> przez <b>' + this.user + '</b>.</small></div><hr />';

            $('#modal-podglad-data').html(this.data);
            $('#modal-podglad-plan').html(this.nazwa + this.zmiana);
            $('#modal-podglad-pojazd').html(this.marka + ' ' + this.model + ' #' + this.nr_tab);
            $('#modal-podglad-kilometry').html(this.kilometry + ' km');
            $('#modal-podglad-typ').html(this.nazwa_typu);
            $('#modal-podglad-uwagi').html(this.uwagi);

            if (this.rezerwa == 0) {
                $('#btnStat1').prop('disabled', true);
                $('#btnStat2').prop('disabled', false);
                $('#btnStat1').val(id);
                $('#btnStat1').removeClass('btn-primary').addClass('btn-secondary')
                $('#btnStat2').removeClass('btn-secondary').addClass('btn-primary')
                $('#modal-podglad-statystyka').html('<iframe class="embed-responsive-item" src="https://mzkp-strzelce.pl/panel/json/podskrypty/raport_statystyka.php?idr=' + id + '"></iframe>');
            }
            else $("#modal-podglad-statystyka-row").css("display", "none");

            $('#modal-podglad-galeria').html("");

            $.get("json/raporty_screeny.php?id=" + id, function (data) {

                var dane = JSON.parse(data);

                $.each(dane, function () {

                    document.getElementById("modal-podglad-galeria").innerHTML += '<a href=\"' + this.screeny + '\" target="_blank"><img class="m-1" style="max-height: 150px; max-width: 265px; border: 1px outset #222;" src=\"' + this.screeny + '\"/></a> &nbsp;';

                });

                document.getElementById("modal-podglad-loading").style.display = "none";
                document.getElementById("modal-podglad-zawartosc").style.display = "block";

            });

        });

    });

}

let rezerwa;

function ZlozRaport(id) {

    $(".fileinput-upload-button").off()
    if ($("#galeria")) {
        $("#galeria").empty()
        $("#galeria").css("height", "0px")
    }

    galeria = [];
    linkizimgura = []

    $("#modal-dodawanie-przycisk").prop('disabled', true);

    document.getElementById("modal-dodawanie-loading").style.display = "block";
    document.getElementById("modal-dodawanie-zawartosc").style.display = "none";

    rezerwa = 0;

    $("#modal-dodawanie").modal("show");

    $("#modal-dodawanie-kilometry").val("");
    $("#modal-dodawanie-uwagi").val("");
    $("#modal-dodawanie-statystyka").val("");
    $("#modal-dodawanie-etykieta").val("");
    $("#modal-dodawanie-statystyka-row").css("display", "block");

    kilometry.removeClass("is-invalid");
    kilometry.removeClass("is-valid");

    statystyka.removeClass("is-invalid");
    statystyka.removeClass("is-valid");

    $("#modal-dodawanie-etykieta-error").css("display", "none");

    //$('#input-id').fileinput('destroy');

    $.get("json/raporty_tabela1.php?id=" + id, function (data) {

        var dane = JSON.parse(data);

        $.each(dane, function () {

            $('#modal-dodawanie-data').val(this.data);
            $('#modal-dodawanie-plan').val(this.nazwa + this.zmiana);
            $('#modal-dodawanie-pojazd').val(this.marka + ' ' + this.model + ' #' + this.nr_tab);
            $('#modal-dodawanie-typ').val(this.nazwa_typu);
            $('#modal-dodawanie-id').val(id);

            if (this.rezerwa == 1) {

                $("#modal-dodawanie-statystyka-row").css("display", "none");
                rezerwa = 1;
            }

        });

        function restartFoteczki() {

            if ($("#input-id").length == 0) {
                let input = $("<input id=\"input-id\" type=\"file\" name=\"image\" multiple=\"\">")
                $(".file-input").append(input)
                $(".file-input").removeClass('is-locked')
            }

            $("#input-id").fileinput({
                overwriteInitial: false,
                uploadUrl: "#",
                showDrag: true,
                theme: "fas",
                language: "pl",
                showZoom: true,
                showCaption: false,
                showBrowse: false,
                uploadAsync: false,
                showCancel: false,
                previewFileType: "image",
                browseClass: "btn btn-success",
                browseLabel: " Wybierz screeny z przejazdu",
                browseIcon: "<i class=\"fas fa-plus-square\"></i> ",
                removeClass: "btn btn-danger",
                removeLabel: " UsuĹ wszystkie",
                removeIcon: "<i class=\"fas fa-trash-alt\"></i> ",
                uploadClass: "btn btn-info",
                uploadLabel: " Wgraj wszystkie",
                uploadIcon: "<i class=\"fas fa-cloud-upload-alt\"></i> ",
                allowedFileExtensions: ["jpg", "jpeg", "gif", "png"],
                initialPreviewAsData: true,
                showUploadedThumbs: false,
                browseOnZoneClick: true,
                layoutTemplates: {
                    actionZoom: '',
                    actionUpload: ''
                },
                maxFileCount: 50
            })

            $(".fileinput-upload-button").off()

            $(".fileinput-upload-button").on("click", () => {
                $(".pliki-alert").remove()
                $("#modal-service button").off()
                $("#modal-service button").each((i, el) => {
                    el.disabled = true
                    el.title = ""
                })
                $("#modal-service button").on("click", () => { window.alert("Serwis naleĹźy zmieniÄ przed uploadem!") })

                if ($('#input-id').fileinput('getFileList').length > 0) {
                    $("#modal-dodawanie-przycisk").prop('disabled', true);
                    $('#input-id').fileinput('disable');
                    $(".fileinput-upload-button").remove()
                    $(".fileinput-remove-button").remove()
                    $(".fileinput-remove").remove()
                    let pasekVis = document.getElementsByClassName("kv-upload-progress")[0]
                    pasekVis.style.display = "block"
                    //$('#input-id').fileinput('upload');
                    let valuenow = 0
                    let pasek = pasekVis.children[0].children[0]
                    pasek.setAttribute("aria-valuenow", valuenow)
                    let pliki = $('#input-id').fileinput('getFileList')

                    let operand = linkizimgura.length

                    new Promise((resolve, reject) => {

                        let i = operand
                        function XD() {
                            new Promise(async (resolvein, rejectin) => {

                                valuenow = parseInt(((galeria.length - operand + 0.1) / pliki.length) * 100)
                                pasek.style.width = valuenow + "%"
                                pasek.innerText = valuenow + "%"
                                pasek.setAttribute("aria-valuenow", valuenow)

                                let set = jQuery.extend(true, {}, settings)

                                if (settings._type == "imgur")
                                    set.data = pliki[i - operand]
                                else {
                                    var form_data = new FormData();
                                    form_data.append('image', pliki[i - operand])
                                    set.data = form_data
                                }

                                $.ajax(set).done(function (response) {
                                    let resp = JSON.parse(response)
                                    if (resp.data == "") {
                                        rejectin()
                                        throw "imgur brak odpowiedzi"
                                    }
                                    if (set._type == "imgur") {
                                        galeria[i] = (resp.data)
                                        linkizimgura[i] = (resp.data.link)
                                    }
                                    else if (set._type == "beeimg") {
                                        console.log(resp)
                                        galeria[i] = (resp.files)
                                        galeria[i].link = ("https://www." + resp.files.url.substring(2))
                                        linkizimgura[i] = ("https://www." + resp.files.url.substring(2))
                                    }
                                    else if (set._type == "imgbb") {
                                        galeria[i] = (resp.data)
                                        galeria[i].link = (resp.data.url)
                                        linkizimgura[i] = (resp.data.url)
                                    }

                                    galeria[i].namepikczur = pliki[i - operand].name
                                    galeria[i].lastModified = pliki[i - operand].lastModified
                                    valuenow = parseInt(((galeria.length - operand) / pliki.length) * 100)

                                    pasek.style.width = valuenow + "%"
                                    pasek.innerText = valuenow + "%"
                                    pasek.setAttribute("aria-valuenow", valuenow)
                                    resolvein()
                                    if (galeria.length == operand + pliki.length && !galeria.includes(undefined))
                                        resolve()
                                    else if (i == operand + pliki.length) {
                                        reject("wtf actually")
                                        throw ("imgur brak zgodnosci ilosci wyslanych z iloscia otrzymanych odpowiedzi")
                                    }
                                }).fail((err) => {
                                    if (err.status == 500 || err.readyState == 0)
                                        setTimeout(() => {
                                            valuenow = parseInt(((galeria.length - operand) / pliki.length) * 100)
                                            XD()
                                        }, 500);
                                    else {
                                        pasek.style.width = "100%"
                                        pasek.innerText = "0%"
                                        pasek.classList.remove("bg-success", "progress-bar-success")
                                        pasek.classList.add("bg-danger", "progress-bar-danger")
                                        i = pliki.length + 1
                                        if (err.status != 400) {
                                            if (err.response)
                                                window.alert("wystÄpiĹ bĹÄd " + err.response)
                                            else if (err.responseText)
                                                window.alert("wystÄpiĹ bĹÄd " + err.responseText + (settings._type == "imgur" ? " \n\nOdĹwieĹź stronÄ i sprĂłbuj skorzystaÄ z uploadu na imgbb lub beeimg." : ""))
                                            else
                                                window.alert("wystÄpiĹ bĹÄd " + err)
                                            $(".file-input").hide()
                                            $("#galeria").empty()
                                            $("#galeria").css("height", "auto")
                                            let alert = $("<div class='alert alert-danger'>")
                                            alert.text("WystÄpiĹ krytyczny bĹÄd uploadu. OdĹwieĹź stronÄ i wybierz inny serwis uploadu.")
                                            $("#galeria").append(alert)
                                            $("#galeria").show()
                                        }

                                        console.log(err)
                                        reject(err)
                                    }
                                });
                            }).then(() => {
                                if ((i + 1) < (operand + pliki.length)) {
                                    i++
                                    XD()
                                }
                            }).catch((err) => {
                                if (err.status == 500) {
                                    valuenow = parseInt(((galeria.length - operand) / pliki.length) * 100)
                                    XD()
                                }
                                else {
                                    pasek.style.width = "100%"
                                    pasek.innerText = "0%"
                                    pasek.classList.remove("bg-success", "progress-bar-success")
                                    pasek.classList.add("bg-danger", "progress-bar-danger")
                                    i = pliki.length + 1
                                    if (err.status != 400) {
                                        if (err.response)
                                            window.alert("wystÄpiĹ bĹÄd " + err.response)
                                        else if (err.responseText)
                                            window.alert("wystÄpiĹ bĹÄd " + err.responseText + (settings._type == "imgur" ? " \n\nOdĹwieĹź stronÄ i sprĂłbuj skorzystaÄ z uploadu na imgbb lub beeimg." : ""))
                                        else
                                            window.alert("wystÄpiĹ bĹÄd " + err)
                                        $(".file-input").hide()
                                        $("#galeria").empty()
                                        $("#galeria").css("height", "auto")
                                        let alert = $("<div class='alert alert-danger'>")
                                        alert.text("WystÄpiĹ krytyczny bĹÄd uploadu. OdĹwieĹź stronÄ i wybierz inny serwis uploadu.")
                                        $("#galeria").append(alert)
                                        $("#galeria").show()

                                    }
                                    console.log(err)
                                    reject(err)
                                }
                            })
                        }
                        XD()


                    }).then(() => {

                        if ($("#galeria")) {
                            $("#galeria").empty()
                            $("#galeria").css("height", "0px")
                        }

                        let wysokoscgalerii = {
                            aInternal: 0,
                            aListener: function (val) { },
                            set a(val) {
                                this.aInternal = val;
                                this.aListener(val);
                            },
                            get a() {
                                return this.aInternal;
                            },
                            registerListener: function (listener) {
                                this.aListener = listener;
                            }
                        }

                        wysokoscgalerii.registerListener(() => {
                            $("#galeria").css("height", wysokoscgalerii.a + "px")
                        })
                        $("#modal-dodawanie-przycisk").prop('disabled', false);
                        $(".file-input").empty()
                        let ul = $("<ul class=\"mt-2\"></ul>")
                        ul.addClass("list-group")
                        galeria.forEach((element, index) => {
                            let div = $("<li></li>")
                            div.addClass("list-group-item", "ui-state-default")
                            div.css('cursor', 'grab')
                            div.mousedown(function () { div.css('cursor', 'grabbing') })
                            div.mouseup(function () { div.css('cursor', 'grab') })
                            div.prop('title', 'ZĹap by zmieniÄ kolejnoĹÄ.');

                            //let div2 = $("<div class=\"container\"></div>")
                            let div3 = $("<div class=\"row\" style=\"width:100%\"></div>")
                            let div4 = $("<div class=\"align-middle\" style=\"width:20%\">")
                            let img = $("<img src=" + element.link + " class=\"align-middle\" style=\"max-width: 150px; max-height: 75px;\"/>")
                            let div5 = $("<div class=\"align-middle\" style=\"width:70%\"> Nazwa pliku: <i>" + element.namepikczur + "</i> <br/>\
                    Ostatnio modyfikowany: <i>" + timeConverter(element.lastModified) + "</i></div>")
                            let div6 = $("<div class=\"align-middle\" style=\"width:10%\"></div>")
                            let button = $("<button type=\"button\" class=\"float-right btn btn-danger align-middle ml-1 mr-1\"><i class=\"nav-icon fas fa-trash-alt \"></i></button>")
                            let button2 = $("<button type=\"button\" class=\"float-right btn btn-success align-middle ml-1 mr-1\"><i class=\"nav-icon fas fa-search-plus \"></i></button>")

                            button.on("click", () => {
                                div.find('img').map(function (i, el) {
                                    linkizimgura = linkizimgura.filter(e => e !== el.src)
                                })
                                wysokoscgalerii.a -= parseInt(div.outerHeight(true))
                                div.remove()
                            })

                            button2.on("click", () => {
                                window.open(element.link, '_blank', 'location=no,status=no');
                            })

                            button.prop('title', 'NaciĹnij, by usunÄÄ ten obrazek.');
                            button2.prop('title', 'NaciĹnij, by zobaczyÄ przesĹany obraz w peĹnej rozdzielczoĹci.');

                            div3.addClass("d-table")
                            div4.addClass("d-table-cell")
                            div5.addClass("d-table-cell")
                            div6.addClass("d-table-cell")

                            div6.append(button)
                            div6.append(button2)
                            div4.append(img)
                            div3.append(div4)
                            //div2.append(div3)
                            div3.append(div5)
                            div3.append(div6)
                            div.append(div3)
                            ul.append(div)

                            img.on("load", () => {
                                wysokoscgalerii.a += parseInt(div.outerHeight(true))
                            })

                        });

                        $("#galeria").append(ul)
                        $("#galeria").css("overflow", "hidden")

                        ul.sortable({
                            update: function (event, ui) {
                                console.log('old update called');
                            }
                        });
                        ul.on('sortupdate', function () {
                            console.log('update called');
                            linkizimgura = $(this).find('li').map(function (i, el) {
                                return el.children[0].children[0].children[0].src
                            }).get()
                        });
                        ul.disableSelection();

                        wysokoscgalerii.a += parseInt(ul.css("margin-top"))

                        let adder = $("<button type=\"button\" class=\"btn btn btn-info float-left mt-1 mr-1\"><i class=\"nav-icon fas fa-cloud-upload-alt\"></i><span class=\"hidden-xs\"> Dodaj screeny</span></button>")
                        adder.prop('title', 'NaciĹnij, by wysĹaÄ dodatkowe screeny.');
                        adder.on("click", () => {
                            $(".file-input").empty()
                            let input = $("<input id=\"input-id\" type=\"file\" name=\"image\" multiple=\"\">")
                            $(".file-input").append(input)
                            input.fileinput({
                                uploadUrl: "#",
                                overwriteInitial: false,
                                showDrag: true,
                                theme: "fas",
                                language: "pl",
                                showZoom: true,
                                showCaption: false,
                                showBrowse: false,
                                uploadAsync: false,
                                showCancel: false,
                                previewFileType: "image",
                                browseClass: "btn btn-success",
                                browseLabel: " Wybierz screeny z przejazdu",
                                browseIcon: "<i class=\"fas fa-plus-square\"></i> ",
                                removeClass: "btn btn-danger",
                                removeLabel: " UsuĹ wszystkie",
                                removeIcon: "<i class=\"fas fa-trash-alt\"></i> ",
                                uploadClass: "btn btn-info",
                                uploadLabel: " Wgraj wszystkie",
                                uploadIcon: "<i class=\"fas fa-cloud-upload-alt\"></i> ",
                                allowedFileExtensions: ["jpg", "jpeg", "gif", "png"],
                                initialPreviewAsData: true,
                                showUploadedThumbs: false,
                                browseOnZoneClick: true,
                                layoutTemplates: {
                                    actionZoom: '',
                                    actionUpload: ''
                                },
                                maxFileCount: 50

                            })
                            $(".fileinput-upload-button").off()
                            $(".file-input").removeClass('is-locked')
                            restartFoteczki()
                        })

                        let restarter = $("<button type=\"button\" class=\"btn btn-danger float-left mt-1 ml-1\"><i class=\"nav-icon fas fa-trash-alt\"></i><span class=\"hidden-xs\"> UsuĹ wszystkie screeny</span></button>")
                        restarter.prop('title', 'NaciĹnij, by rozpoczÄÄ wgrywanie screenĂłw od nowa.');
                        restarter.on("click", () => {
                            galeria = [];
                            linkizimgura = []
                            wysokoscgalerii.a = 0
                            $("#galeria").empty()
                            $("#galeria").css("height", "0px")
                            $(".file-input").empty()
                            let input = $("<input id=\"input-id\" type=\"file\" name=\"image\" multiple=\"\">")
                            $(".file-input").append(input)
                            input.fileinput({
                                uploadUrl: "#",
                                overwriteInitial: false,
                                showDrag: true,
                                theme: "fas",
                                language: "pl",
                                showZoom: true,
                                showCaption: false,
                                showBrowse: false,
                                uploadAsync: false,
                                showCancel: false,
                                previewFileType: "image",
                                browseClass: "btn btn-success",
                                browseLabel: " Wybierz screeny z przejazdu",
                                browseIcon: "<i class=\"fas fa-plus-square\"></i> ",
                                removeClass: "btn btn-danger",
                                removeLabel: " UsuĹ wszystkie",
                                removeIcon: "<i class=\"fas fa-trash-alt\"></i> ",
                                uploadClass: "btn btn-info",
                                uploadLabel: " Wgraj wszystkie",
                                uploadIcon: "<i class=\"fas fa-cloud-upload-alt\"></i> ",
                                allowedFileExtensions: ["jpg", "jpeg", "gif", "png"],
                                initialPreviewAsData: true,
                                showUploadedThumbs: false,
                                browseOnZoneClick: true,
                                layoutTemplates: {
                                    actionZoom: '',
                                    actionUpload: ''
                                },
                                maxFileCount: 50

                            })
                            $(".fileinput-upload-button").off()
                            $(".file-input").removeClass('is-locked')
                            restartFoteczki()
                        })
                        $("#galeria").append(adder)
                        $("#galeria").append(restarter)
                        wysokoscgalerii.a += parseInt(restarter.outerHeight(true))

                    }).catch((err) => {
                        try {
                            if (JSON.parse(err.responseText).data.error.code == 429) {
                                let alert = document.createElement("div")
                                alert.classList.add("alert", "alert-danger")
                                alert.innerText = "PrzekroczyĹeĹ dopuszczalnÄ iloĹÄ uploadowanych screenĂłw na adres IP. SprĂłbuj ponownie za pĂłĹ godziny."
                                pasekVis.appendChild(alert)
                                pasek.classList.remove("bg-success", "progress-bar-success")
                                pasek.classList.add("bg-danger", "progress-bar-danger")
                            }
                            else console.error(err)
                        }
                        catch (erro) {
                            window.alert("wystÄpiĹ nieoczekiwany bĹÄd po stronie serwisu " + settings._type + "! SprĂłbuj ponownie" + err + erro)
                            console.error(erro)
                            console.error(err)
                        }

                    })
                }
                else {
                    let pasekVis = document.getElementsByClassName("file-input")[0]
                    let alert = document.createElement("div")
                    alert.classList.add("alert", "alert-danger", "mt-1", "mb-1", "pliki-alert")
                    alert.innerText = "Brak prawidĹowych plikĂłw do wysĹania na serwer! Dodaj prawidĹowe pliki graficzne."
                    pasekVis.prepend(alert)
                }

            });
        }
        restartFoteczki()

        document.getElementById("modal-dodawanie-loading").style.display = "none";
        document.getElementById("modal-dodawanie-zawartosc").style.display = "block";

        $("#modal-dodawanie-przycisk").prop('disabled', false);


    });


}

//listerner do dodawania
document.getElementById("form-dodawanie").addEventListener("submit", event => {

    event.preventDefault();

    const error = walidacjaDodawanie();

    if (error === '') {

        dodaj();

    } else {

        toastr.error('BĹÄd! WypeĹnij poprawnie wszystkie wymagane pola.');

    }

});

let kilometry = $('#modal-dodawanie-kilometry');
let uwagi = $('#modal-dodawanie-uwagi');
let statystyka = $('#modal-dodawanie-statystyka');


let id = $('#modal-dodawanie-id');

function walidacjaDodawanie() {
    let err = '';

    if (kilometry.val().length === 0) {

        err = 1;
        kilometry.addClass("is-invalid");

    } else {

        kilometry.removeClass("is-invalid");
        kilometry.addClass("is-valid");

    }

    if (statystyka.val().length === 0 && rezerwa == 0) {

        err = 1;
        statystyka.addClass("is-invalid");

    } else {

        statystyka.removeClass("is-invalid");
        statystyka.addClass("is-valid");

    }

    if (linkizimgura.length === 0) {

        err = 1;
        $("#modal-dodawanie-etykieta-error").css("display", "block");

    } else {

        $("#modal-dodawanie-etykieta-error").css("display", "none");

    }

    return err;

}

function dodaj() {

    document.getElementById("modal-dodawanie-loading").style.display = "block";
    document.getElementById("modal-dodawanie-zawartosc").style.display = "none";

    $("#modal-dodawanie-przycisk").prop('disabled', true);

    function encodeQueryData(data) {

        let ret = [];
        for (let d in data)
            ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
        return ret.join('&');

    }

    var datalogin = encodeQueryData({
        'id': id.val(),
        'kilometry': kilometry.val(),
        'statystyka': statystyka.val(),
        'screeny': linkizimgura.join(","),
        'uwagi': uwagi.val()
    });

    $.ajax({

        type: 'POST',
        data: datalogin,
        url: 'scripts/raporty_nowy.php',
        success: function (responseText) {

            if (responseText == 0) {

                //nie udalo sie usunac, jakis blad

                $("#modal-dodawanie").modal("hide");

                toastr.error('BĹÄd! Nie udaĹo siÄ zĹoĹźyÄ raportu.');

            } else if (responseText == 1) {

                $("#modal-dodawanie").modal("hide");

                toastr.success('Sukces! Poprawnie zĹoĹźono raport.');

                Tabela1();

            } else if (responseText == 2) {

                //nie udalo sie usunac, ranga technik
                $("#modal-dodawanie").modal("hide");

                toastr.error('BĹÄd! WypeĹnij wszystkie wymagane pola.');


            } else if (responseText == 3) {

                //nie udalo sie usunac, ranga technik
                $("#modal-dodawanie").modal("hide");

                toastr.error('BĹÄd! Czas na zĹoĹźenie raportu upĹynÄĹ.');


            } else if (responseText == 4) {

                //nie udalo sie usunac, ranga technik
                $("#modal-dodawanie").modal("hide");

                toastr.error('BĹÄd! NiewĹaĹciwa liczba kilometrĂłw.');


            } else if (responseText == 5) {

                $("#modal-dodawanie").modal("hide");

                toastr.success('Sukces! Poprawnie zĹoĹźono raport poprawkowy.');

                Tabela4();

            }
            else if (responseText == 6) {

                $("#modal-dodawanie").modal("hide");

                toastr.error('BĹÄd! NiewĹaĹciwa statystyka z przejazdu.');

            }

        }


    })

}

$("#modal-service button").on("click", (event) => {
    $("#modal-service button").each((i, el) => {
        el.disabled = false
        el.title = ""
    })
    event.target.disabled = true
    event.target.title = "JuĹź wybraĹeĹ ten serwis!"

    switch (event.target.value) {
        case "imgur":
            settings._type = "imgur"
            settings.url = "https://api.imgur.com/3/image"
            settings.headers = {
                "Authorization": "Client-ID d531c71ea40ab45"
            }
            break;
        case "beeimg":
            settings._type = "beeimg"
            settings.url = "https://beeimg.com/api/upload/file/json/"
            settings.headers = {}
            break;
        case "imgbb":
            settings._type = "imgbb"
            settings.url = "https://api.imgbb.com/1/upload?key=6fbf1c460dbc221ba2807e1652a1fbb8"
            settings.headers = {}
            break;

    }
    settings.data = null

})