<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    <div id="paypal-button-container">
        <script
            src="https://sandbox.paypal.com/sdk/js?client-id=AZb7AzOCkvMPK8OrRzAcVrUF1FYT9VkOGNZqtde2XSgSPvy__YLxFYU6q27MFXp3xvhuVtybulmSM19m"></script>
        <script>
            paypal.Buttons({
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: "<?= $total ?>"
                            }
                        }]
                    });
                },
            }),
        </script>

    </div>
</body>

</html>