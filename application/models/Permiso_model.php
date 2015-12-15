<?php
class Permiso_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function obtenerPermisos()
    {
      $where=array("PER__ESTADO"=>true);
      $query=$this->db
      ->select("PER_ID,PER_DESCRIPCION")
      ->from("PERMISOS")
      ->where($where)
      ->get();
      return $query->result();
    }

    public function entregarPermisoDocumento($datos=array())
    {
      $query=$this->db->insert("PERMISOS_DOCUMENTOS",$datos);
      return true;
    }

    public function obtenerPermisoDocumentos($id_doc)
    {
      $where=array("PERMISOS_DOCUMENTOS.DOC_ID"=>$id_doc,"DOCUMENTOS.DOC_ESTADO"=>1);
      $query=$this->db
      ->select("DOCUMENTOS.DOC_ID,DOCUMENTOS.DOC_NOMBRE,USUARIO.USU_ID,USUARIO.USU_NOMBRES,USUARIO.USU_APELLIDO_PATERNO,PERMISOS.PER_DESCRIPCION,PERMISOS.PER_ID")
      ->from("PERMISOS_DOCUMENTOS")
      ->join("DOCUMENTOS","PERMISOS_DOCUMENTOS.DOC_ID=DOCUMENTOS.DOC_ID")
      ->join("USUARIO","PERMISOS_DOCUMENTOS.USU_ID=USUARIO.USU_ID")
      ->join("PERMISOS","PERMISOS_DOCUMENTOS.PER_ID=PERMISOS.PER_ID")
      ->where($where)
      ->get();
      return $query->result();
    }

    public function eliminarPermisoDocumentos($id_doc,$id_usu,$id_per)
    {
      $this->db->where('DOC_ID', $id_doc);
      $this->db->where('USU_ID', $id_usu);
      $this->db->where('PER_ID', $id_per);
      $this->db->delete('PERMISOS_DOCUMENTOS');
      return true;
    }

    public function tienePermisosDocumento($datos=array())
    {
      $where=$datos;
      $query=$this->db
      ->select("PER_ID")
      ->from("PERMISOS_DOCUMENTOS")
      ->where($where)
      ->get();
      return $query->row();
    }

    public function obtenerPermisosPortafolio($id)
    {
      $where=array("PERMISOS_PROYECTO.PRO_ID"=>$id,"PORTAFOLIO.PRO_ESTADO"=>TRUE);
      $query=$this->db
      ->select("PERMISOS_PROYECTO.PRO_ID,PERMISOS_PROYECTO.USU_ID,PERMISOS_PROYECTO.PER_ID,USU_NOMBRES,USU_APELLIDO_PATERNO,PRO_NOMBRE,PER_DESCRIPCION")
      ->from("PERMISOS_PROYECTO")
      ->join("USUARIO","PERMISOS_PROYECTO.USU_ID=USUARIO.USU_ID")
      ->join("PORTAFOLIO","PERMISOS_PROYECTO.PRO_ID=PORTAFOLIO.PRO_ID")
      ->join("PERMISOS","PERMISOS_PROYECTO.PER_ID=PERMISOS.PER_ID")
      ->where($where)
      ->get();
      return $query->result();
    }
    
    public function tienePermisosPortafolio($datos=array())
    {
      $where=$datos;
      $query=$this->db
      ->select("PER_ID")
      ->from("PERMISOS_PROYECTO")
      ->where($where)
      ->get();
      return $query->row();
    }

    public function entregarPermisosPortafolio($datos=array())
    {
      $query=$this->db->insert("PERMISOS_PROYECTO",$datos); /* Falta validación */
      return true;
    }

    public function editarPermisosPortafolio($datos=array())
    {
      $this->db->where('PRO_ID', $datos["PRO_ID"]);
      $this->db->where('USU_ID', $datos["USU_ID"]); // Multiples invocaciones de where genera una clausula AND
      $this->db->update('PERMISOS_PROYECTO',$datos);
      return true;
    }

    public function eliminarPermisoUsuario($id, $usuario)
    {
      $this->db->where('PRO_ID', $id);
      $this->db->where('USU_ID', $usuario);
      $this->db->delete('PERMISOS_PROYECTO');
      return true;
    }

}
