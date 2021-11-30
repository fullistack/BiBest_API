<meta charset="UTF-8">
<table width="100%" style="" cellpadding="0" border="0" bgcolor="#EDF2F7">
    <tr style="margin: 0 auto; font-family: Arial, sans-serif;">
        <td style="width: 25%;"></td>
        <td style="width: 50%; max-width: 600px; min-width: 600px;">
            <div style="padding: 25px 30px">
                <div style="text-align: center">
                    <img src="http://usoundeddev.workteamhtml.link/images/logo.png" height="80" alt="BeBest">
                </div>
            </div>
            <div style="background-color: #fff;padding: 30px 30px; margin-bottom: 25px;">
                <div style="width: 100%; margin-bottom: 15px;">
                    <h3 style="color: #292C32;margin-top: 0;margin-bottom: 15px;">Привет {{ $name }}!</h3>
                    <p style="color: #292C32;margin-top: 0;margin-bottom: 20px; font-size: 16px;">Нажмите на кнопку, чтобы подтвердить свой адрес электронной почты и активировать учетную запись</p>
                    <div style="text-align: center; margin-bottom: 30px;">
                        <a href="{{ $url }}" target="_blank" style="padding: 15px 40px; color: #fff; text-decoration: none; background-color: #F04973; background: linear-gradient(90deg, #F04973 0%, #FA6655 100%);box-shadow: 0 15px 25px rgba(193, 42, 61, 0.2); border-radius: 7px; font-weight: bold; font-size: 21px; line-height: 182.85%;">Подтвердить</a>
                    </div>
                </div>
                <div style="width: 100%; margin-top: 25px; padding-top: 25px; border-top: 1px solid #e8e5ef;">
                    <p style="color: #718096;margin-top: 0;margin-bottom: 0; font-size: 16px;">
                        <a href="{{ $url }}" style="color: #F04973">{{ $url }}</a>
                    </p>
                </div>
            </div>

        </td>
        <td style="width: 25%;"></td>
    </tr>
</table>
<style>
    body {margin: 0;padding: 0;color: #718096;}
</style>
