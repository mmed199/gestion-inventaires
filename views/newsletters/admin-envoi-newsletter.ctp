<h1>Envoyer une Newsletter</h1>
<br/>
    <?php
    echo $form->create("Newl",array("url"=>array('controller'=>'newls','action'=>'index','admin'=>true)));
    echo $form->input("Newl.msg",array('rows'=>'16','div' => false,"style"=>'padding:10px;width:95%;',"class"=>'round',"label"=>'Newsletter : <br/>',"type"=>'textarea'));
    echo "<br/>";
    echo $form->submit("Envoyer",array('div' => false,"style"=>'display:inline;margin-left:5px;padding:3px 7px'));
    echo $form->end();
    ?>