<base href="{{ asset('') }}">
<div marginheight="0" marginwidth="0" style="background:#f0f0f0">
    <div id="wrapper" style="background-color:#f0f0f0">

        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600"
            style="margin:0 auto;width:600px!important;min-width:600px!important" class="container">
            <tbody>
                <tr>
                    <td align="center" valign="middle" style="background:#ffffff">
                        <table style="width:580px;border-bottom:1px solid #007de0" cellpadding="0" cellspacing="0"
                            border="0">
                            <tbody>
                                <tr>
                                    <td align="left" valign="middle" style="width:auto;height:60px">
                                        <a href="#" style="border:0"  height="30"
                                            style="display:block;border:0px">
                                            <img src="http://nemoviz.com/assets/langdingpage/images/vni/Nemoviz_logo_crop.png" height="30"
                                                style="display:block;border:0px;float: left;"> <b
                                                style="float: left;line-height: 100px;color: red;font-size: 20px;"></b>
                                        </a>
                                    </td>
                                    <td align="right" valign="middle" style="padding-right:15px; with:800px;">
                                        Created date: <?php echo date('Y/m/d'); ?><br>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="middle" style="background:#ffffff">
                        <table style="width:580px" cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <tr>
                                    <td align="left" valign="middle"
                                        style="font-family:Arial,Helvetica,sans-serif;font-size:24px;color:#007de0;text-transform:uppercase;font-weight:bold;padding:25px 10px 15px 10px">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="middle"
                                        style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding:0 10px 20px 10px;line-height:17px">
                                        <h1>{{ $mail->title }} </h1>

                                        <p>{!! $mail->content !!}</p>
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <td align="left" valign="middle" style="font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#666666;padding:0 10px 20px 10px;line-height:17px">
                                    <a href="/login" class="btn"  style="border: 0px;
                                                background: #007de0;
                                                text-decoration: none;
                                                border-radius: 5px;
                                                padding: 10px;    margin-left: 40%;
                                                color: white;" >
                                                    Go to Control Panel
                                    </a>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="middle" style="background:#ffffff;padding-top:20px">
                        <table style="width:500px" cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <tr>
                                    <td align="center" valign="middle"
                                        style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">
                                        <br> Have questions?
                                        You can check out our FAQ or Inbox our Page for more information:
                                        <a href="#"
                                            style="font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#0066cc;text-decoration:none;font-weight:bold"
                                            >
                                            https://www.facebook.com/Nemo3dvn
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
