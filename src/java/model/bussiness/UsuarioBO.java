/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model.bussiness;

import java.util.List;
import model.entities.Usuario;
import org.hibernate.Hibernate;
import org.hibernate.Query;
import org.hibernate.Session;

/**
 *
 * @author liot
 */
public class UsuarioBO {

    Session session;

    public UsuarioBO() {
        session = NewHibernateUtil.getSessionFactory().openSession();

    }

    public Usuario getUsuario(String rut) {
        Query query = session.createQuery("from Usuario where USU_ID = :rut ");
        query.setParameter("rut", rut);
        return (Usuario) query.uniqueResult();
    }

}
