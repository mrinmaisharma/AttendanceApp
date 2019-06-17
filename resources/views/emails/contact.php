<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
</head>
<body>
    <div style="width:600px;padding:15px;margin:0 auto;background-color:#111;color:#f1f1f1">
        <div style="margin:0 auto;width:430px;height:100px">
            <div style="position:relative;float:left;width:100px;">
                <img src="https://image.ibb.co/bH72TV/cf.png" style="width:100%;resize:both" alt="Console Flare" border="0">
            </div>
            <div style="padding:16px 15px;font-size:2em;text-shadow:-4px 4px 6px #777;position:relative;float:left;width:300px;color:#fff">
                Console Flare
            </div>
        </div>
        <br/>
        <br/>
        <div style="position:relative;width:100%;color:#00a199">
            <p style="color:#fff">
                Dear user,
                <br>
                You have a new Admin request on your Console FLare.
                <br>
            </p>
            <table style="padding:5px;">
                <tr>
                    <td style="padding:5px;padding-right:20px;border:1px solid #ccc">Name of client: </td>
                    <td style="padding:5px;border:1px solid #ccc"><?php echo $data['clientName']; ?></td>
                </tr>
                <tr>
                    <td style="padding:5px;padding-right:20px;border:1px solid #ccc">Email: </td>
                    <td style="padding:5px;border:1px solid #ccc"><?php echo $data['clientEmail']; ?></td>
                </tr>
                <tr>
                    <td style="padding:5px;padding-right:20px;border:1px solid #ccc">Phone: </td>
                    <td style="padding:5px;border:1px solid #ccc"><?php echo $data['clientPhn']; ?></td>
                </tr>
                <tr>
                    <td style="padding:5px;padding-right:20px;border:1px solid #ccc">Company: </td>
                    <td style="padding:5px;border:1px solid #ccc"><?php echo $data['clientCompany']; ?></td>
                </tr>
                <tr>
                    <td style="padding:5px;padding-right:20px;border:1px solid #ccc">Role: </td>
                    <td style="padding:5px;border:1px solid #ccc"><?php echo $data['clientRole']; ?></td>
                </tr>
                <tr>
                    <td style="padding:5px;padding-right:20px;border:1px solid #ccc">Message/Query: </td>
                    <td style="padding:5px;border:1px solid #ccc"><?php echo $data['clientMsg']; ?></td>
                </tr>
            </table>
            <br/>
            <br/>
            <p style="color:#919191">
                Ragards <br/>
                <strong>www.consoleflare.com</strong>
            </p>
        </div>
    </div>
</body>
</html>