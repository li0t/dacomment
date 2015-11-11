/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controller;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import model.bussiness.UsuarioBO;
import model.entities.Usuario;
import org.apache.struts.action.ActionForm;
import org.apache.struts.action.ActionForward;
import org.apache.struts.action.ActionMapping;

/**
 *
 * @author liot
 */
public class UsuarioAction extends org.apache.struts.action.Action {

    /* forward name="success" path="" */
    private static final String USUARIO = "usuario";
    private static final String ERROR = "error";

    /**
     * This is the action called from the Struts framework.
     *
     * @param mapping The ActionMapping used to select this instance.
     * @param form The optional ActionForm bean for this request.
     * @param request The HTTP Request we are processing.
     * @param response The HTTP Response we are processing.
     * @throws java.lang.Exception
     * @return
     */
    @Override
    public ActionForward execute(ActionMapping mapping, ActionForm form,
            HttpServletRequest request, HttpServletResponse response)
            throws Exception {
        
        String rut = request.getParameter("rut");
        UsuarioBO userBO = new UsuarioBO();
        Usuario user = userBO.getUsuario(rut);
        HttpSession sesion = request.getSession(true);
        try {
            sesion.setAttribute("usuario", user);
            return mapping.findForward(USUARIO);
        } catch (Exception e) {
            return mapping.findForward(ERROR);
        }
    }

}
