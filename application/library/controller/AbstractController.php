<?php

namespace Library\Controller;

/**
 * Description of AbstractController
 *
 * @author rodrigocantarino
 */
abstract class AbstractController {
    
    public function init() {
        parent::init();
        $this->initView();
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->_redirector     = $this->_helper->getHelper('Redirector');

        // O trecho de código abaixo tem o objetivo de carregar a Sessão de Módulo independente de passar ou não pela Controller /pagina-inicial-modulo/index
        // Essa necessidade sugiu pois os Links do sistema acessados pelo menu de favoritos não carregam a variável de Sessão de Módulo 
        $nome_controller = $this->getRequest()->getControllerName();
        $nome_action = $this->getRequest()->getActionName();
        $nome_module = $this->getRequest()->getModuleName();
        
        if ($nome_controller !== 'tela' && $nome_controller !== 'pagina-inicial-modulo') {
            // Recupera os dados do módulo pelo nome da controller
            $objModuloSistema = new Application_Model_Public_GiModuloSistema();
            $moduloSelecionado = $objModuloSistema->getModuloByDsController($nome_controller);
            // Carrega os dados na variável de sessão
            $this->setDadosModuloSessao($moduloSelecionado);
        }

        $params_request = $this->getRequest()->getParams();
        $this->setSessaoHistoricoNavegacao($nome_module, $nome_controller, $nome_action, $params_request);
    }
    
    private function initView(){
        
    }
    
    private function setUserSession(){
        
    }
    
    public function getUserSession() {
        $sessionAcl = new Zend_Session_Namespace('sessionAcl');
        $id_tipo_perfil = $this->getIdPerfilLogado();
        if (!isset($sessionAcl->acl)) {
            $classAclSetup = new Cgmi_Acl_Setup($id_tipo_perfil);
            $acl = unserialize($classAclSetup->getSaveAclSession());
        } else {
            $acl = unserialize($sessionAcl->acl);
        }
        return $acl;
    }
    
}
