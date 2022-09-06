var accessToken = "";
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(document).on("click", ".payNow", function () {
        $("#paymentModal").modal("show");
    });

    $(document).on("click", ".dangerButton", function () {
        $("#paymentModal").modal("hide");
        createToken();
    });

    const paymentAdditionalInfo = (bid_id, amount, resource, req_id) => {
        $.ajax({
            url: bKpaymentAdditional,
            type: "POST",
            data: { bid_id, amount, resource, req_id },
            success: function (data) {
                console.log(data);
            },
            error: function (err) {
                console.log(err);
            },
        });
    };

    function createToken() {
        $.ajax({
            url: bKasTokenUrl,
            type: "POST",
            contentType: "application/json",
            success: function (data) {
                console.log("got data from token  ..");
                console.log(JSON.stringify(data));
                accessToken = JSON.stringify(data);
            },
            error: function () {
                console.log("error");
            },
        });
    }
    createToken();

    var paymentConfig = {
        createCheckoutURL: bKashCreatePaymentUrl,
        executeCheckoutURL: bKashExecutePaymentUrl,
    };

    var paymentRequest;
    paymentRequest = {
        amount: 20,
        intent: "request",
        invoice: $(".invoice").text(),
        rid: $(".reqId").val(),
    };

    $(document).on("click", ".payNow", function () {
        $("#paymentModal").modal("show");
        let bid_id = $(this).attr("data-id");
        let resource = $(this).attr("data-resource");
        let amount = $(this).attr("data-amount");
        let req_id = $(".reqId").val();
        paymentRequest.amount = amount;
        let response = paymentAdditionalInfo(bid_id, amount, resource, req_id);
    });

    bKash.init({
        paymentMode: "checkout",
        paymentRequest: paymentRequest,
        createRequest: function (request) {
            console.log("=> createRequest (request) :: ");
            console.log(request);
            $.ajax({
                url:
                    paymentConfig.createCheckoutURL +
                    "?amount=" +
                    paymentRequest.amount +
                    "&invoice=" +
                    paymentRequest.invoice,
                type: "GET",
                contentType: "application/json",
                success: function (data) {
                    // console.log('got data from create  ..');
                    // console.log('data ::=>');
                    // console.log(JSON.stringify(data));
                    var obj = JSON.parse(data);
                    if (data && obj.paymentID != null) {
                        paymentID = obj.paymentID;
                        bKash.create().onSuccess(obj);
                    } else {
                        createToken();
                        alert("Something Went Wront Please Try again later");
                        console.log("error");
                        bKash.create().onError();
                    }
                },
                error: function () {
                    createToken();
                    alert("Something Went Wront Please Try again later");
                    console.log("error");
                    bKash.create().onError();
                },
            });
        },

        executeRequestOnAuthorization: function () {
            console.log("=> executeRequestOnAuthorization");
            $.ajax({
                url:
                    paymentConfig.executeCheckoutURL +
                    "?paymentID=" +
                    paymentID,
                type: "GET",
                contentType: "application/json",
                success: function (data) {
                    data = JSON.parse(data);
                    if (data && data.paymentID != null) {
                        Swal.fire(
                            "Success!",
                            "!! Payment Success !!",
                            "success"
                        );
                        location.reload();
                        // alert('[SUCCESS] data : ' + JSON.stringify(data));
                    } else {
                        createToken();
                        alert("Something Went Wront Please Try again later");
                        bKash.execute().onError();
                    }
                },
                error: function () {
                    createToken();
                    alert("Something Went Wront Please Try again later");
                    bKash.execute().onError();
                },
            });
        },
    });

    console.log("Right after init ");

    function callReconfigure(val) {
        bKash.reconfigure(val);
    }

    function clickPayButton() {
        $("#bKash_button").trigger("click");
    }
});
