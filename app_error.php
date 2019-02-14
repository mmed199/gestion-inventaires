<?php 
class AppError extends ErrorHandler {
    function error404($params) {
      $this->controller->redirect('/');
      parent::error404($params);
    }
}