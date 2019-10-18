<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(login_check($mysqli) == true){ 
    if(isset($_POST['submit'])){
        $user_id = $_SESSION['user_id'];
        $stmt = $mysqli->prepare('SELECT person, lastname, firstname, email FROM members WHERE id = ?');
        $stmt->bind_param('s', $user_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($person, $lastname, $firstname, $email);
        $stmt->fetch();
        
        $section = $_POST['section'];
        $year_in = $_POST['year_in'];
        $year_out = $_POST['year_out'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $occupation_type = $_POST['occupation_type'];
        $occupation = $_POST['occupation'];
        $telephone = $_POST['telephone'];
        if(isset($_POST['mailing_subscription'])){
        	$mailing_subscription = $_POST['mailing_subscription'];
        }
        else{
        	$mailing_subscription = 'NO';
        }
        if(isset($_POST['contact_agree'])){
        	$contact_agree = $_POST['contact_agree'];
        }
        else{
        	$contact_agree = 'NO';
        }
        
        $description = $_POST['description'];
        
        $section = sanitizeInput($section);
        $year_in = sanitizeInput($year_in);
        $year_out = sanitizeInput($year_out);
        $country = sanitizeInput($country);
        $city = sanitizeInput($city);
        $occupation_type = sanitizeInput($occupation_type);
        $occupation = sanitizeInput($occupation);
        $telephone = sanitizeInput($telephone);
        $mailing_subscription = sanitizeInput($mailing_subscription);
        $contact_agree = sanitizeInput($contact_agree);
        $description = sanitizeInput($description);
        
        $stmt = $mysqli->prepare('SELECT alumn_id FROM alumni WHERE user_id = ?');
        $stmt->bind_param('s', $user_id);
        $stmt->execute();
        $stmt->store_result();

        
        if($stmt->num_rows == 1){
            echo "<div class='alert alert-danger'>Sie sind bereits als Alumna/Alumnus registriert!</div>";
        }
        
        $stmt = $mysqli->prepare('INSERT INTO alumni (user_id, person, lastname, firstname, email, section, year_in,
                year_out, country, city, occupation_type, occupation, telephone, mailing_subscription, contact_agree, description) VALUES
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('ssssssssssssssss', $user_id, $person, $lastname, $firstname, $email, $section, $year_in, $year_out,
                $country, $city, $occupation_type, $occupation, $telephone, $mailing_subscription, $contact_agree, $description);

        if($stmt->execute()){
            $get_alumn_id = $mysqli->prepare('SELECT alumn_id FROM alumni WHERE user_id = ?');
            $get_alumn_id->bind_param('s', $user_id);
            $get_alumn_id->execute();
            $get_alumn_id->store_result();
            $get_alumn_id->bind_result($alumn_id);
            $get_alumn_id->fetch();

            
            //start year group
            $check = $mysqli->prepare('SELECT group_id FROM groups WHERE group_name = ?');
            $group_name = 'Ankunft '.$year_in;
            $check->bind_param('s', $group_name);
            $check->execute();
            $check->store_result();
            
            if($check->num_rows == 0){
                $create = $mysqli->prepare('INSERT INTO groups (group_name) VALUES (?)');
                $create->bind_param('s', $group_name);
                $create->execute();
                
                $get_group_id = $mysqli->prepare('SELECT group_id FROM groups WHERE group_name = ?');
                $get_group_id->bind_param('s', $group_name);
                $get_group_id->execute();
                $get_group_id->store_result();
                $get_group_id->bind_result($group_id);
                $get_group_id->fetch();
            }
            else{
                $check->bind_result($group_id);
                $check->fetch();
            }


            $link = $mysqli->prepare('INSERT INTO int_alumni_groups (alumn_id, group_id) VALUES (?, ?)');
            $link->bind_param('ss', $alumn_id, $group_id);
            $link->execute();
            
            //end year group
            if($year_out){
                $check = $mysqli->prepare('SELECT group_id FROM groups WHERE group_name = ?');
                $group_name = 'Abgang '.$year_out;
                $check->bind_param('s', $group_name);
                $check->execute();
                $check->store_result();

                if($check->num_rows == 0){
                    $create = $mysqli->prepare('INSERT INTO groups (group_name) VALUES (?)');
                    $create->bind_param('s', $group_name);
                    $create->execute();

                    $get_group_id = $mysqli->prepare('SELECT group_id FROM groups WHERE group_name = ?');
                    $get_group_id->bind_param('s', $group_name);
                    $get_group_id->execute();
                    $get_group_id->store_result();
                    $get_group_id->bind_result($group_id);
                    $get_group_id->fetch();
                }
                else{
                    $check->bind_result($group_id);
                    $check->fetch();
                }


                $link = $mysqli->prepare('INSERT INTO int_alumni_groups (alumn_id, group_id) VALUES (?, ?)');
                $link->bind_param('ss', $alumn_id, $group_id);
                $link->execute();
            }
            
            //section group
            $check = $mysqli->prepare('SELECT group_id FROM groups WHERE group_name = ?');
            $group_name = $section;
            $check->bind_param('s', $group_name);
            $check->execute();
            $check->store_result();
            
            if($check->num_rows == 0){
                $create = $mysqli->prepare('INSERT INTO groups (group_name) VALUES (?)');
                $create->bind_param('s', $group_name);
                $create->execute();
                
                $get_group_id = $mysqli->prepare('SELECT group_id FROM groups WHERE group_name = ?');
                $get_group_id->bind_param('s', $group_name);
                $get_group_id->execute();
                $get_group_id->store_result();
                $get_group_id->bind_result($group_id);
                $get_group_id->fetch();
            }
            else{
                $check->bind_result($group_id);
                $check->fetch();
            }


            $link = $mysqli->prepare('INSERT INTO int_alumni_groups (alumn_id, group_id) VALUES (?, ?)');
            $link->bind_param('ss', $alumn_id, $group_id);
            $link->execute();
            
            //country group
            $check = $mysqli->prepare('SELECT group_id FROM groups WHERE group_name = ?');
            $group_name = $country;
            $check->bind_param('s', $group_name);
            $check->execute();
            $check->store_result();
            
            if($check->num_rows == 0){
                $create = $mysqli->prepare('INSERT INTO groups (group_name) VALUES (?)');
                $create->bind_param('s', $group_name);
                $create->execute();
                
                $get_group_id = $mysqli->prepare('SELECT group_id FROM groups WHERE group_name = ?');
                $get_group_id->bind_param('s', $group_name);
                $get_group_id->execute();
                $get_group_id->store_result();
                $get_group_id->bind_result($group_id);
                $get_group_id->fetch();
            }
            else{
                $check->bind_result($group_id);
                $check->fetch();
            }


            $link = $mysqli->prepare('INSERT INTO int_alumni_groups (alumn_id, group_id) VALUES (?, ?)');
            $link->bind_param('ss', $alumn_id, $group_id);
            $link->execute();
            
            //occupation type group
            if($occupation_type){
                $check = $mysqli->prepare('SELECT group_id FROM groups WHERE group_name = ?');
                $group_name = $occupation_type;
                $check->bind_param('s', $group_name);
                $check->execute();
                $check->store_result();

                if($check->num_rows == 0){
                    $create = $mysqli->prepare('INSERT INTO groups (group_name) VALUES (?)');
                    $create->bind_param('s', $group_name);
                    $create->execute();

                    $get_group_id = $mysqli->prepare('SELECT group_id FROM groups WHERE group_name = ?');
                    $get_group_id->bind_param('s', $group_name);
                    $get_group_id->execute();
                    $get_group_id->store_result();
                    $get_group_id->bind_result($group_id);
                    $get_group_id->fetch();
                }
                else{
                    $check->bind_result($group_id);
                    $check->fetch();
                }


                $link = $mysqli->prepare('INSERT INTO int_alumni_groups (alumn_id, group_id) VALUES (?, ?)');
                $link->bind_param('ss', $alumn_id, $group_id);
                $link->execute();
            }
            
            //city group
            if($city){
                $check = $mysqli->prepare('SELECT group_id FROM groups WHERE group_name = ?');
                $group_name = $city;
                $check->bind_param('s', $group_name);
                $check->execute();
                $check->store_result();

                if($check->num_rows == 0){
                    $create = $mysqli->prepare('INSERT INTO groups (group_name) VALUES (?)');
                    $create->bind_param('s', $group_name);
                    $create->execute();

                    $get_group_id = $mysqli->prepare('SELECT group_id FROM groups WHERE group_name = ?');
                    $get_group_id->bind_param('s', $group_name);
                    $get_group_id->execute();
                    $get_group_id->store_result();
                    $get_group_id->bind_result($group_id);
                    $get_group_id->fetch();
                }
                else{
                    $check->bind_result($group_id);
                    $check->fetch();
                }


                $link = $mysqli->prepare('INSERT INTO int_alumni_groups (alumn_id, group_id) VALUES (?, ?)');
                $link->bind_param('ss', $alumn_id, $group_id);
                $link->execute();
            }
            
            //occupation group
            if($occupation){
                $check = $mysqli->prepare('SELECT group_id FROM groups WHERE group_name = ?');
                $group_name = $occupation;
                $check->bind_param('s', $group_name);
                $check->execute();
                $check->store_result();

                if($check->num_rows == 0){
                    $create = $mysqli->prepare('INSERT INTO groups (group_name) VALUES (?)');
                    $create->bind_param('s', $group_name);
                    $create->execute();

                    $get_group_id = $mysqli->prepare('SELECT group_id FROM groups WHERE group_name = ?');
                    $get_group_id->bind_param('s', $group_name);
                    $get_group_id->execute();
                    $get_group_id->store_result();
                    $get_group_id->bind_result($group_id);
                    $get_group_id->fetch();
                }
                else{
                    $check->bind_result($group_id);
                    $check->fetch();
                }


                $link = $mysqli->prepare('INSERT INTO int_alumni_groups (alumn_id, group_id) VALUES (?, ?)');
                $link->bind_param('ss', $alumn_id, $group_id);
                $link->execute();
            }
            
            echo "<div class='alert alert-success'>Erfolgreich in der Alumnidatenbank registriert!<br>"
            . "<a href='index.php?path=pages/controlpanel'>Zum Controlpanel...</a></div>";
        }
        
        
    }
    
?>

<h1>Registrierung als Alumna/Alumnus der DSA</h1>
<p>So können Sie in Kontakt mit der großen DSA-Familie bleiben!</p>
<br>
<div class="container col-sm-6 col-sm-offset-3">
    <table class="table table-bordered">
        <tr class="active">
            <td>
                <h3 class="text-center"><small>ALUMNIREGISTRIERUNG</small></h3>
            </td>
        </tr>
        <tr>
            <td>
                <br>
                <form class="form-horizontal" id="alumniregform" action="index.php?path=pages/alumni/registration" method="post">
                  <div class="form-group">
                    <label for="section" class="col-sm-2 col-sm-offset-1 control-label">Primärgruppe</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="section" name="section" required>
                                    <option value="">Bitte wählen...</option>
                                    <option>Human-Spezialklasse</option>
                                    <option>Real-Spezialklasse</option>
                                    <option>Rumänisch</option>
                                    <option>Deutsch</option>
                                    <option>Mathematik</option>
                                    <option>Geschichte</option>
                                    <option>Englisch</option>
                                    <option>Französisch</option>
                                    <option>Physik</option>
                                    <option>Chemie</option>
                                    <option>Biologie</option>
                                    <option>Informatik</option>
                                    <option>Geographie</option>
                                    <option>Sport</option>
                                    <option>Sozialwissenschaften</option>
                                    <option>Musik</option>
                                    <option>Kunst</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="year_in" class="col-sm-2 col-sm-offset-1 control-label">Ankunftsjahr</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="year_in" placeholder="Notwendig" name="year_in" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="year_out" class="col-sm-2 col-sm-offset-1 control-label">Abgangsjahr</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="year_out" placeholder="" name="year_out">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="country" class="col-sm-2 col-sm-offset-1 control-label">Land</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="country" name="country" required>
                            <option value="">Bitte wählen...</option>
                            <option value="DE">Deutschland</option>
                            <option value="AT">Österreich</option>
                            <option value="CH">Schweiz</option>
                            <option value="RO">Rumänien</option>
                            <optgroup label="A">
                                    <option value="AF">Afghanistan</option>
                                    <option value="EG">Ägypten</option>
                                    <option value="AX">Åland</option>
                                    <option value="AL">Albanien</option>
                                    <option value="DZ">Algerien</option>
                                    <option value="AS">Amerikanisch-Samoa</option>
                                    <option value="VI">Amerikanische Jungferninseln</option>
                                    <option value="AD">Andorra</option>
                                    <option value="AO">Angola</option>
                                    <option value="AI">Anguilla</option>
                                    <option value="AQ">Antarktis</option>
                                    <option value="AG">Antigua und Barbuda</option>
                                    <option value="GQ">Äquatorialguinea</option>
                                    <option value="AR">Argentinien</option>
                                    <option value="AM">Armenien</option>
                                    <option value="AW">Aruba</option>
                                    <option value="AC">Ascension</option>
                                    <option value="AZ">Aserbaidschan</option>
                                    <option value="ET">Äthiopien</option>
                                    <option value="AU">Australien</option>
                            </optgroup>
                            <optgroup label="B">
                                    <option value="BS">Bahamas</option>
                                    <option value="BH">Bahrain</option>
                                    <option value="BD">Bangladesch</option>
                                    <option value="BB">Barbados</option>
                                    <option value="BY">Belarus (Weißrussland)</option>
                                    <option value="BE">Belgien</option>
                                    <option value="BZ">Belize</option>
                                    <option value="BJ">Benin</option>
                                    <option value="BM">Bermuda</option>
                                    <option value="BT">Bhutan</option>
                                    <option value="BO">Bolivien</option>
                                    <option value="BA">Bosnien und Herzegowina</option>
                                    <option value="BW">Botswana</option>
                                    <option value="BV">Bouvetinsel</option>
                                    <option value="BR">Brasilien</option>
                                    <option value="VG">Britische Jungferninseln</option>
                                    <option value="IO">Britisches Territorium im Indischen Ozean</option>
                                    <option value="BN">Brunei Darussalam</option>
                                    <option value="BG">Bulgarien</option>
                                    <option value="BF">Burkina Faso</option>
                                    <option value="BI">Burundi</option>
                            </optgroup>
                            <optgroup label="C">
                                    <option value="EA">Ceuta, Melilla</option>
                                    <option value="CL">Chile</option>
                                    <option value="CN">Volksrepublik China</option>
                                    <option value="CP">Clipperton</option>
                                    <option value="CK">Cookinseln</option>
                                    <option value="CR">Costa Rica</option>
                                    <option value="CI">Côte d'Ivoire (Elfenbeinküste)</option>
                            </optgroup>
                            <optgroup label="D">
                                    <option value="DK">Dänemark</option>
                                    <option value="DE">Deutschland</option>
                                    <option value="DG">Diego Garcia</option>
                                    <option value="DM">Dominica</option>
                                    <option value="DO">Dominikanische Republik</option>
                                    <option value="DJ">Dschibuti</option>
                            </optgroup>
                            <optgroup label="E">
                                    <option value="EC">Ecuador</option>
                                    <option value="SV">El Salvador</option>
                                    <option value="ER">Eritrea</option>
                                    <option value="EE">Estland</option>
                            </optgroup>
                            <optgroup label="F">
                                    <option value="FK">Falklandinseln</option>
                                    <option value="FO">Färöer</option>
                                    <option value="FJ">Fidschi</option>
                                    <option value="FI">Finnland</option>
                                    <option value="FR">Frankreich</option>
                                    <option value="GF">Französisch-Guayana</option>
                                    <option value="PF">Französisch-Polynesien</option>
                            </optgroup>
                            <optgroup label="G">
                                    <option value="GA">Gabun</option>
                                    <option value="GM">Gambia</option>
                                    <option value="GE">Georgien</option>
                                    <option value="GH">Ghana</option>
                                    <option value="GI">Gibraltar</option>
                                    <option value="GD">Grenada</option>
                                    <option value="GR">Griechenland</option>
                                    <option value="GL">Grönland</option>
                                    <option value="GB">Großbritannien</option>
                                    <option value="GP">Guadeloupe</option>
                                    <option value="GU">Guam</option>
                                    <option value="GT">Guatemala</option>
                                    <option value="GG">Guernsey (Kanalinsel)</option>
                                    <option value="GN">Guinea</option>
                                    <option value="GW">Guinea-Bissau</option>
                                    <option value="GY">Guyana</option>
                            </optgroup>
                            <optgroup label="H">
                                    <option value="HT">Haiti</option>
                                    <option value="HM">Heard- und McDonald-Inseln</option>
                                    <option value="HN">Honduras</option>
                                    <option value="HK">Hongkong</option>
                            </optgroup>
                            <optgroup label="I">
                                    <option value="IN">Indien</option>
                                    <option value="ID">Indonesien</option>
                                    <option value="IM">Insel Man</option>
                                    <option value="IQ">Irak</option>
                                    <option value="IR">Iran</option>
                                    <option value="IE">Irland</option>
                                    <option value="IS">Island</option>
                                    <option value="IL">Israel</option>
                                    <option value="IT">Italien</option>
                            </optgroup>
                            <optgroup label="J">
                                    <option value="JM">Jamaika</option>
                                    <option value="JP">Japan</option>
                                    <option value="YE">Jemen</option>
                                    <option value="JE">Jersey (Kanalinsel)</option>
                                    <option value="JO">Jordanien</option>
                            </optgroup>
                            <optgroup label="K">
                                    <option value="KY">Kaimaninseln</option>
                                    <option value="KH">Kambodscha</option>
                                    <option value="CM">Kamerun</option>
                                    <option value="CA">Kanada</option>
                                    <option value="IC">Kanarische Inseln</option>
                                    <option value="CV">Kap Verde</option>
                                    <option value="KZ">Kasachstan</option>
                                    <option value="QA">Katar</option>
                                    <option value="KE">Kenia</option>
                                    <option value="KG">Kirgisistan</option>
                                    <option value="KI">Kiribati</option>
                                    <option value="CC">Kokosinseln</option>
                                    <option value="CO">Kolumbien</option>
                                    <option value="KM">Komoren</option>
                                    <option value="CD">Demokratische Republik Kongo</option>
                                    <option value="KP">Demokratische Volksrepublik Korea (Nordkorea)</option>
                                    <option value="KR">Republik Korea (Südkorea)</option>
                                    <option value="HR">Kroatien</option>
                                    <option value="CU">Kuba</option>
                                    <option value="KW">Kuwait</option>
                            </optgroup>
                            <optgroup label="L">
                                    <option value="LA">Laos</option>
                                    <option value="LS">Lesotho</option>
                                    <option value="LV">Lettland</option>
                                    <option value="LB">Libanon</option>
                                    <option value="LR">Liberia</option>
                                    <option value="LY">Libyen</option>
                                    <option value="LI">Liechtenstein</option>
                                    <option value="LT">Litauen</option>
                                    <option value="LU">Luxemburg</option>
                            </optgroup>
                            <optgroup label="M">
                                    <option value="MO">Macao</option>
                                    <option value="MG">Madagaskar</option>
                                    <option value="MW">Malawi</option>
                                    <option value="MY">Malaysia</option>
                                    <option value="MV">Malediven</option>
                                    <option value="ML">Mali</option>
                                    <option value="MT">Malta</option>
                                    <option value="MA">Marokko</option>
                                    <option value="MH">Marshallinseln</option>
                                    <option value="MQ">Martinique</option>
                                    <option value="MR">Mauretanien</option>
                                    <option value="MU">Mauritius</option>
                                    <option value="YT">Mayotte</option>
                                    <option value="MK">Mazedonien</option>
                                    <option value="MX">Mexiko</option>
                                    <option value="FM">Mikronesien</option>
                                    <option value="MD">Moldawien (Republik Moldau)</option>
                                    <option value="MC">Monaco</option>
                                    <option value="MN">Mongolei</option>
                                    <option value="ME">Montenegro</option>
                                    <option value="MS">Montserrat</option>
                                    <option value="MZ">Mosambik</option>
                                    <option value="MM">Myanmar (Burma)</option>
                            </optgroup>
                            <optgroup label="N">
                                    <option value="NA">Namibia</option>
                                    <option value="NR">Nauru</option>
                                    <option value="NP">Nepal</option>
                                    <option value="NC">Neukaledonien</option>
                                    <option value="NZ">Neuseeland</option>
                                    <option value="NI">Nicaragua</option>
                                    <option value="NL">Niederlande</option>
                                    <option value="AN">Niederländische Antillen</option>
                                    <option value="NE">Niger</option>
                                    <option value="NG">Nigeria</option>
                                    <option value="NU">Niue</option>
                                    <option value="MP">Nördliche Marianen</option>
                                    <option value="NF">Norfolkinsel</option>
                                    <option value="NO">Norwegen</option>
                            </optgroup>
                            <optgroup label="O">
                                    <option value="OM">Oman</option>
                                    <option value="XO">Orbit</option>
                                    <option value="AT">Österreich</option>
                                    <option value="TL">Osttimor (Timor-Leste)</option>
                            </optgroup>
                            <optgroup label="P">
                                    <option value="PK">Pakistan</option>
                                    <option value="PS">Palästinensische Autonomiegebiete</option>
                                    <option value="PW">Palau</option>
                                    <option value="PA">Panama</option>
                                    <option value="PG">Papua-Neuguinea</option>
                                    <option value="PY">Paraguay</option>
                                    <option value="PE">Peru</option>
                                    <option value="PH">Philippinen</option>
                                    <option value="PN">Pitcairninseln</option>
                                    <option value="PL">Polen</option>
                                    <option value="PT">Portugal</option>
                                    <option value="PR">Puerto Rico</option>
                            </optgroup>
                            <optgroup label="Q"></option>
                            </optgroup>
                            <optgroup label="R">
                                    <option value="TW">Republik China (Taiwan)</option>
                                    <option value="CG">Republik Kongo</option>
                                    <option value="RE">Réunion</option>
                                    <option value="RW">Ruanda</option>
                                    <option value="RU">Russische Föderation</option>
                            </optgroup>
                            <optgroup label="S">
                                    <option value="BL">Saint-Barthélemy</option>
                                    <option value="MF">Saint-Martin</option>
                                    <option value="SB">Salomonen</option>
                                    <option value="ZM">Sambia</option>
                                    <option value="WS">Samoa</option>
                                    <option value="SM">San Marino</option>
                                    <option value="ST">São Tomé und Príncipe</option>
                                    <option value="SA">Saudi-Arabien</option>
                                    <option value="SE">Schweden</option>
                                    <option value="CH">Schweiz</option>
                                    <option value="SN">Senegal</option>
                                    <option value="RS">Serbien</option>
                                    <option value="SC">Seychellen</option>
                                    <option value="SL">Sierra Leone</option>
                                    <option value="ZW">Simbabwe</option>
                                    <option value="SG">Singapur</option>
                                    <option value="SK">Slowakei</option>
                                    <option value="SI">Slowenien</option>
                                    <option value="SO">Somalia</option>
                                    <option value="ES">Spanien</option>
                                    <option value="LK">Sri Lanka</option>
                                    <option value="SH">St. Helena</option>
                                    <option value="KN">St. Kitts und Nevis</option>
                                    <option value="LC">St. Lucia</option>
                                    <option value="PM">Saint-Pierre und Miquelon</option>
                                    <option value="VC">St. Vincent und die Grenadinen</option>
                                    <option value="ZA">Südafrika</option>
                                    <option value="SD">Sudan</option>
                                    <option value="GS">Südgeorgien und die Südlichen Sandwichinseln</option>
                                    <option value="SR">Suriname</option>
                                    <option value="SJ">Svalbard und Jan Mayen</option>
                                    <option value="SZ">Swasiland</option>
                                    <option value="SY">Syrien</option>
                            </optgroup>
                            <optgroup label="T">
                                    <option value="TJ">Tadschikistan</option>
                                    <option value="TZ">Tansania</option>
                                    <option value="TH">Thailand</option>
                                    <option value="TG">Togo</option>
                                    <option value="TK">Tokelau</option>
                                    <option value="TO">Tonga</option>
                                    <option value="TT">Trinidad und Tobago</option>
                                    <option value="TA">Tristan da Cunha</option>
                                    <option value="TD">Tschad</option>
                                    <option value="CZ">Tschechische Republik</option>
                                    <option value="TN">Tunesien</option>
                                    <option value="TR">Türkei</option>
                                    <option value="TM">Turkmenistan</option>
                                    <option value="TC">Turks- und Caicosinseln</option>
                                    <option value="TV">Tuvalu</option>
                            </optgroup>
                            <optgroup label="U">
                                    <option value="UG">Uganda</option>
                                    <option value="UA">Ukraine</option>
                                    <option value="HU">Ungarn</option>
                                    <option value="UY">Uruguay</option>
                                    <option value="UZ">Usbekistan</option>
                            </optgroup>
                            <optgroup label="V">
                                    <option value="VU">Vanuatu</option>
                                    <option value="VA">Vatikanstadt</option>
                                    <option value="VE">Venezuela</option>
                                    <option value="AE">Vereinigte Arabische Emirate</option>
                                    <option value="US">Vereinigte Staaten von Amerika (USA)</option>
                                    <option value="GB">Vereinigtes Königreich Großbritannien und Nordirland</option>
                                    <option value="VN">Vietnam</option>
                            </optgroup>
                            <optgroup label="W">
                                    <option value="WF">Wallis und Futuna</option>
                                    <option value="CX">Weihnachtsinsel</option>
                                    <option value="EH">Westsahara</option>
                            </optgroup>
                            <optgroup label="Z">
                                    <option value="CF">Zentralafrikanische Republik</option>
                                    <option value="CY">Zypern</option>
                            </optgroup>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="city" class="col-sm-2 col-sm-offset-1 control-label">Stadt</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="city" placeholder="" name="city">
                    </div>
                  </div>
                  <div class="form-group">
                      <label for="occupation_type" class="col-sm-2 col-sm-offset-1 control-label">Beschäfti-<br>gungsgruppe</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="occupation_type" name="occupation_type">
                            <option value="">Bitte wählen...</option>
                            <option>Architecture and Engineering</option>
                            <option>Arts, Design, Entertainment, Sports, and Media</option>
                            <option>Building and Grounds Cleaning and Maintenance</option>
                            <option>Business and Financial Operations</option>
                            <option>Community and Social Service</option>
                            <option>Computer and Mathematical</option>
                            <option>Construction and Extraction</option>
                            <option>Education, Training, and Library</option>
                            <option>Farming, Fishing, and Forestry</option>
                            <option>Food Preparation and Serving</option>
                            <option>Healthcare Practitioners and Technical</option>
                            <option>Healthcare Support</option>
                            <option>Installation, Maintenance, and Repair</option>
                            <option>Legal</option>
                            <option>Life, Physical, and Social Science</option>
                            <option>Management</option>
                            <option>Military Specific</option>
                            <option>Office and Administrative Support</option>
                            <option>Personal Care and Service</option>
                            <option>Production/Manufacturing</option>
                            <option>Protective Service</option>
                            <option>Sales and Related</option>
                            <option>Transportation and Material Moving</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="occupation" class="col-sm-2 col-sm-offset-1 control-label">Beschäfti-<br>gung</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="occupation" placeholder="" name="occupation">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="telephone" class="col-sm-2 col-sm-offset-1 control-label">Telefon-<br>nummer</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="telephone" placeholder="" name="telephone">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="description" class="col-sm-2 col-sm-offset-1 control-label">Über mich</label>
                      <div class="col-sm-8">
                          <textarea class="form-control" id="description" placeholder="Kurze Beschreibung" rows="4" name="description" maxlength="1000"></textarea>
                      </div>
                  </div>
            </td>
        </tr>
        <tr>
            <td>
                  <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="mailing_subscription" value="YES"> Ich möchte regelmäßig spannende Neuigkeiten über die DSA per E-Mail bekommen.
                        </label>
                      </div>
                    </div>
                  </div>
            </td>
        </tr>
                <tr>
            <td>
                  <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="contact_agree" value="YES"> Ich möchte von anderen Alumni Mails bekommen (ohne Veröffentlichung Ihrer Adresse).
                        </label>
                      </div>
                    </div>
                  </div>
            </td>
        </tr>
        <tr>
            <td>
                  <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="agreement" value="yes" required> Ich bin damit einverstanden, dass die Daten aus diesem Formular
                          für unbegrenzte Zeit gespeichert werden. Alle Daten, die Sie hier angegeben haben außer E-Mail-Adresse werden vollständing an anderen Alumni weitergegeben.
                        </label>
                      </div>
                    </div>
                  </div>
            </td>
        </tr>
        <tr>
            <td>
                  <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                      <button type="submit" class="btn btn-primary" name="submit" value="submit">Registrieren</button>
                      <a class="btn btn-default" href="index.php?path=pages/alumni/registration" role="button">Reset</a>
                    </div>
                  </div>
                </form>
            </td>
        </tr>
    </table>
</div>


<?php
}
else { ?>
    <div class="alert alert-danger">
        You are not authorized to access this page. <br>
        Please <a href="index.php?path=pages/login">login</a>.
    </div>

<?php 
} ?>