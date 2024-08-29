const provinces = $("#province");
const cities = $("#city");
$.ajax({
    type: "GET",
    url: "https://api.mysupership.vn/v1/partner/areas/province",
    success: function (response) {

        $.each(response.results, function (index, province) {
            provinces.append(`<option value="${province.code}">${province.name}</option>`);
        });
    },
    error: function (xhr, status, error) {
        console.error("Error:", error);
    }
});
provinces.change(function (e) {
    var selectedProvinceId = $(this).val();
    console.log(this);
    if (selectedProvinceId) {
        $.ajax({
            type: "GET",
            url: "https://api.mysupership.vn/v1/partner/areas/district?province=" + selectedProvinceId,
            success: function (response) {

                cities.empty();
                $.each(response.results, function (index, city) {
                    cities.append(`<option value="${city.code}">${city.name}</option>`);
                });
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
            }
        });
    }

});

cities.change(function () {
    var selectedCityId = $(this).val();
    if (selectedCityId) {
        $.ajax({
            type: "GET",
            url: "https://api.mysupership.vn/v1/partner/areas/commune?district=" + selectedCityId,
            success: function (response) {
                const wards = $("#wards");
                wards.empty();
                $.each(response.results, function (index, ward) {
                    wards.append(`<option value="${ward.code}">${ward.name}</option>`);
                });
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
            }
        });
    }
});