<%-- 
    Document   : login
    Created on : 27-10-2015, 08:15:09 PM
    Author     : liot
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>

<%@ taglib uri="http://struts.apache.org/tags-bean" prefix="bean" %>
<%@ taglib uri="http://struts.apache.org/tags-html" prefix="html" %>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>dacomment</title>
    </head>
    <body>
        <h1>Login</h1>
        
        <html:form action="/login">

            <table border="0">
                <tbody>
                    <tr>
                        <td>Enter your name:</td>
                        <td><html:text property="name" /></td>
                    </tr>
                    <tr>
                        <td>Enter your email:</td>
                        <td><html:text property="email" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><html:submit value="Login" /></td>
                    </tr>
                </tbody>
            </table>

        </html:form>
    </body>
</html>
