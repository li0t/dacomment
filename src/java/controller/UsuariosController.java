/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controller;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import model.bussiness.UsuarioBO;
import model.entities.Usuario;

/**
 *
 * @author liot
 */
public class UsuariosController extends HttpServlet {

    protected void getUsuario(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        String rut = request.getParameter("rut");
        UsuarioBO userBO = new UsuarioBO();
        Usuario user = userBO.getUsuario(rut);
        HttpSession sesion = request.getSession(true);
        try {
            sesion.setAttribute("usuario", user);
            response.sendRedirect("usuario.jsp");
        } catch (Exception e) {
            response.sendRedirect("error.jsp");
        }
    }

}
