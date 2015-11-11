/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model.bussiness;

import model.entities.Usuario;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;

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
        Transaction tx = session.beginTransaction();
        Query query = session.createQuery("from Usuario where USU_ID = :rut");
        query.setParameter("rut", rut);
        tx.commit();
        session.close();
        return (Usuario) query.uniqueResult();
    }

}
