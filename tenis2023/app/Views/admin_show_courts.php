<div>
        <?php 
        if(isset($courts)){
            if(sizeof($courts)==0){
                echo "Nema rezultata pretrage";
            } 
            else {
                $table = new CodeIgniter\View\Table();
                $template = [
                    'table_open' => '<table border="1" cellpadding="2" cellspacing="1" >'
                ];
                $table->setTemplate($template);
                $table->setHeading('Tip podloge', 'Opis', 'Obriši');
                echo $table->generate($courts);
            }
        }
 // bolje je rucno napraviti tabelu i dodati polja koja ne postoje u mysql tabeli, vec ih ja dodajem
        ?>
    </div>
