<%-- 
    Document   : success
    Created on : 27-10-2015, 08:19:43 PM
    Author     : liot
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib uri="http://struts.apache.org/tags-bean" prefix="bean" %>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Login Success</title>
    </head>
    <body>
        <h1>Congratulations!</h1>
        <p>You have successfully logged in.</p>
        <p>Your name is: <bean:write name="LoginForm" property="name" />.</p>
        <p>Your email address is: <bean:write name="LoginForm" property="email" />.</p>
    </body>
</html>
