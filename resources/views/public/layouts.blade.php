<html>
<head>
    <title>laravel实战</title>
    <meta charset="utf-8">
</head>
<body topmargin="0">
<table border="1" width="880" align="center" cellspacing="0" cellpadding="0">
    <tr height="50" bgcolor="red" align="center">
        <td>
            <font color="white" size="6" >
                <b>
                @yield("header")
                网页的头部
                @show
                </b>
            </font>
        </td>
    </tr>
    <tr>
        <td>
            <table bgcolor="#5f9ea0"  width="30%" height="500" align="left">
                <tr align="center">
                    <td>
                        <font color="white" size="6" >
                            <b>
                                @section("left")
                                网页的左部
                                @show
                            </b>
                        </font>
                    </td>
                </tr>
            </table>
            <table bgcolor="green" width="70%" height="500" align="right">
                <tr align="center">
                    <td>
                        <font color="white" size="6" >
                            <b>
                                @section("content")
                                网页的内容
                                @show
                            </b>
                        </font>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr height="50" bgcolor="red" align="center">
        <td>
            <font color="white" size="6" >
                <b>
                    @section("bottom")
                    网页的底部
                    @show
                </b>
            </font>
        </td>
    </tr>
</table>
</body>
</html>