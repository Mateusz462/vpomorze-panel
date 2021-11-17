let userSettings = $("[rel=userSettings]").popover({
    content: "<div style='text-align:center'>ładuję...</div>",
    html: true,
    placement: "left",
    sanitize: false,
    title: "Ustawienia użytkownika",
    trigger: "manual"
}).on('click', function () {
    userSettings.attr('data-content', '<div style=\'text-align:center\'>ładuję...</div>');
    $(document).off("click", "#userSettingsBut")
    if (!userSettings.attr('aria-describedby')) {
        function encodeQueryData(data) {
            let ret = [];
            for (let d in data)
                ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
            return ret.join('&');
        }

        var datalogin = encodeQueryData({});
        $.ajax({
            type: 'POST',
            data: datalogin,
            url: 'json/ustawienia.php',
            success: function (responseText) {
                let setDef = ""
                let data = JSON.parse(responseText)
                let div = $('<div class=\'text-center\'>')
                let select = $('<select id="userSettingsSel" class=\'form-control\'>')
                data.wszystkie.forEach((element, index) => {
                    let option = new Option(element.nazwa, element.css)
                    console.log(element.nazwa == data.usera.nazwa)
                    if (element.nazwa == data.usera.nazwa)
                        setDef = element.css
                    select.append(option)
                });
                let label = $('<label>Wybierz styl Panelu:</label>')
                let button = $('<button>').addClass("btn btn-success").text("Wybierz").attr("id", "userSettingsBut")
                $(document).on("click", "#userSettingsBut", () => {
                    console.log("klik")
                    userSettings.popover("hide");
                    var datalogin = encodeQueryData({ styl: $("#userSettingsSel").val() });
                    $.ajax({
                        type: 'POST',
                        data: datalogin,
                        url: 'scripts/ustawienia.php',
                        success: function (responseText) {
                            if (responseText == "1") {
                                toastr.success('Sukces! Poprawnie zmieniono styl Panelu. Odśwież stronę.');
                                window.location.reload()
                            }
                            else
                                toastr.error('Błąd! Nie udało się zmienić stylu Panelu.');
                        }
                    })
                })
                div.append(label)
                div.append(select)
                div.append($("<br/>"))
                div.append(button)
                userSettings.attr('data-content', div.get(0).outerHTML);
                userSettings.popover("show");
            }


        });
    }
    else
        userSettings.popover("hide");

});


