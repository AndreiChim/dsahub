<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$check_alumni = $mysqli->prepare('SELECT alumn_id FROM alumni WHERE user_id = ?');
$user_id = $_SESSION['user_id'];
$check_alumni->bind_param('s', $user_id);
$check_alumni->execute();
$check_alumni->store_result();

if(!login_check($mysqli)){
    header('location:index.php?path=pages/login');
}
elseif(!$check_alumni->num_rows){
    header('location:index.php?path=pages/alumni/registration');
}
$check_alumni->bind_result($alumn_id);
$check_alumni->fetch();

// BECOME FRIENDS
//if(isset($_POST['joingroup'])){
//    $group_id = $_POST['group_id'];
//    $group_id = sanitizeInput($group_id);
//    $join_group = $mysqli->prepare('INSERT INTO int_alumni_groups (alumn_id, group_id) VALUES (?, ?)');
//    $join_group->bind_param('ss', $alumn_id, $group_id);
//    $join_group->execute();
//    header("location:index.php?path=pages/alumni/group&group_id=$group_id");
//}

if(isset($_POST['search'])){
    $query_arr = array();
    
    if(isset($_POST['lastname'])){
        $lastname = $_POST['lastname'];
        $lastname = sanitizeInput($lastname);
        $query_arr['lastname'] = $lastname;
    }
    if(isset($_POST['firstname'])){
        $firstname = $_POST['firstname'];
        $firstname = sanitizeInput($firstname);
        $query_arr['firstname'] = $firstname;
    }
    if(isset($_POST['person'])){
        $person = $_POST['person'];
        $person = sanitizeInput($person);
        $query_arr['person'] = $person;
    }
    if(isset($_POST['section'])){
        $section = $_POST['section'];
        $section = sanitizeInput($section);
        $query_arr['section'] = $section;
    }
    if(isset($_POST['year_in'])){
        $year_in = $_POST['year_in'];
        $year_in = sanitizeInput($year_in);
        $query_arr['year_in'] = $year_in;
    }
    if(isset($_POST['year_out'])){
        $year_out = $_POST['year_out'];
        $year_out = sanitizeInput($year_out);
        $query_arr['year_out'] = $year_out;
    }
    if(isset($_POST['country'])){
        $country = $_POST['country'];
        $country = sanitizeInput($country);
        $query_arr['country'] = $country;
    }
    if(isset($_POST['city'])){
        $city = $_POST['city'];
        $city = sanitizeInput($city);
        $query_arr['city'] = $city;
    }
    if(isset($_POST['occupation_type'])){
        $occupation_type = $_POST['occupation_type'];
        $occupation_type = sanitizeInput($occupation_type);
        $query_arr['occupation_type'] = $occupation_type;
    }
    if(isset($_POST['occupation'])){
        $occupation = $_POST['occupation'];
        $occupation = sanitizeInput($occupation);
        $query_arr['occupation'] = $occupation;
    }
    $query = base64_encode(serialize($query_arr));
    header("location: index.php?path=pages/alumni/search_alumni&query=$query");
}

?>

<a href='index.php?path=pages/alumni/home'>&laquo; Zurück zur Alumni-Homepage</a>
<h1>
    Personensuche
</h1>
<p>
    Geben Sie ein oder mehrere Schlagwörter ein. Sie können auch nur die Anfangsbuchstaben eingeben!
</p>

<div class="container col-sm-6 col-sm-offset-3">
    <table class="table table-bordered">
        <tr class="active">
            <td>
                <h3 class="text-center"><small>PERSONENSUCHE</small></h3>
            </td>
        </tr>
        <tr>
            <td>
                <br>
                <form class="form-horizontal" id="alumnisearch" action="index.php?path=pages/alumni/search_alumni" method="post">
                  <div class="form-group">
                    <label for="lastname" class="col-sm-2 col-sm-offset-1 control-label">Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="lastname" placeholder="" name="lastname">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="firstname" class="col-sm-2 col-sm-offset-1 control-label">Vorname</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="firstname" placeholder="" name="firstname">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="person" class="col-sm-2 col-sm-offset-1 control-label">Kategorie</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="person" name="person">
                            <option value="">Bitte wählen...</option>
                            <option value="student">Schüler</option>
                            <option value="teacher">Lehrer</option>
                            <option value="administrative">Verwaltung</option>
                            <option value="misc">Andere</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="section" class="col-sm-2 col-sm-offset-1 control-label">Primärgruppe</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="section" name="section">
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
                        <input type="text" class="form-control" id="year_in" placeholder="" name="year_in">
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
                        <select class="form-control" id="country" name="country">
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
            </td>
        </tr>
        <tr>
            <td>
                  <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                        <button type="submit" class="btn btn-primary" name="search" value="search">Suchen</button>
                      <a class="btn btn-default" href="index.php?path=pages/alumni/search_alumni" role="button">Reset</a>
                    </div>
                  </div>
                </form>
            </td>
        </tr>
    </table>
</div>

<?php

if(isset($_GET['query'])){
    
    $query = $_GET['query'];
    $query = sanitizeInput($query);
    $query_arr = array();
    $query_arr = unserialize(base64_decode($query));
    
    $sql = 'SELECT lastname, firstname, person, section, year_in, year_out, country, city, occupation_type, occupation, telephone, description, contact_agree FROM alumni WHERE ';
    
    $k = 1;
    foreach($query_arr as $key=>$parameter){
        if($k == 1){
            $sql = $sql.$key." LIKE '".$parameter."%'";
        }
        else{
            if($parameter != ''){
                $sql = $sql." AND ".$key." LIKE '".$parameter."%'";
            }
        }
        $k++;
    }
    $search = $mysqli->prepare($sql);
    $search->execute();
    $search->store_result();
    
    $total = $search->num_rows;
    $order_by = 'lastname';
    $limit = 10;
    $pages = ceil($total / $limit);
    if(isset($_GET['page'])){
        $page = min($pages, sanitizeInput($_GET['page']));
    }
    else{
        $page = 1;
    }
    $offset = ($page - 1) * $limit;
    
    $search = $mysqli->prepare($sql.'ORDER BY '.$order_by.' LIMIT '.$limit.' OFFSET '.$offset);
    $search->execute();
    $search->store_result();
    $search->bind_result($lastname, $firstname, $person, $section, $year_in, $year_out, $country, $city, $occupation_type, $occupation, $telephone, $description, $contact_agree);

    $nr = $page * $limit - $limit;
    ?>
    
<table class="table table-hover">
    <thead>
        <th>
            Nr.
        </th>
        <th>
            Name
        </th>
        <th>
            Vorname
        </th>
        <th>
            Kategorie
        </th>
        <th>
            Primärgruppe
        </th>
        <th>
            Ankunftsjahr
        </th>
        <th>
            Abgangsjahr
        </th>
        <th>
            
        </th>
    </thead>
    
    <?php
    while($search->fetch()){
        $nr++;
    ?>
    <tr data-toggle="collapse" data-target=".target<?php echo $nr; ?>">
        <td>
            <?php echo $nr; ?>
        </td>
        <td>
            <?php echo $lastname; ?>
        </td>
        <td>
            <?php echo $firstname; ?>
        </td>
        <td>
            <?php if($person == 'student') echo 'Schüler'; elseif($person == 'teacher') echo 'Lehrer'; else echo 'Verwaltung'; ?>
        </td>
        <td>
            <?php echo $section; ?>
        </td>
        <td>
            <?php echo $year_in; ?>
        </td>
        <td>
            <?php if($year_out == 0) echo 'Noch an der Schule'; else echo $year_out; ?>
        </td>
        <td>
            <?php
            if($contact_agree == 'YES'){ ?>
            <a class="btn btn-default" href="index.php?path=pages/alumni/message&type=person&recipient=<?php echo $alumn_id; ?>">Nachricht</a>
            <?php
            } ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="hiddenRow">
            <div class="collapse target<?php echo $nr; ?>">
                <b>Telefonnummer</b>: <br>
                <?php echo $telephone; ?>
            </div>
        </td>
        <td colspan="2" class="hiddenRow">
            <div class="collapse target<?php echo $nr; ?>">
                <b>Land:</b> <?php echo $country; ?><br>
                <b>Stadt:</b> <?php echo $city; ?>
            </div>
        </td>
        <td class="hiddenRow">
            <div class="collapse target<?php echo $nr; ?>">
                <b>Beschäftigungsart:</b> <br>
                <?php echo $occupation_type; ?><br>
                <b>Beschäftigung:</b> <br>
                <?php echo $occupation; ?>
            </div>
        </td>
        <td colspan="3" class="hiddenRow">
            <div class="collapse target<?php echo $nr; ?>">
                <b>Persönliche Beschreibung:</b> <br>
                <?php echo $description; ?>
            </div>
        </td>
    </tr>
    <?php
    }
    ?>
</table>
<?php

    if($total > $limit){ ?>

    <nav aria-label="Page navigation">
      <ul class="pagination">
        <li>
          <a href="index.php?path=pages/alumni/search_alumni&query=<?php echo $query; ?>&page=1" aria-label="First page">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li>
          <a href="index.php?path=pages/alumni/search_alumni&query=<?php echo $query; ?>&page=<?php if($page > 1) echo $page-1; else echo 1; ?>" aria-label="Previous page">
            <span aria-hidden="true">&lsaquo;</span>
          </a>
        </li>
        <?php
        for($i = 1; $i <= $pages; $i++){
            if($i == $page){
                echo "<li class='active'><a href='index.php?path=pages/alumni/search_alumni&query=".$query."&page=".$i."'>".$i."</a></li>";
            }
            else{
                echo "<li><a href='index.php?path=pages/alumni/search_alumni&query=".$query."&page=".$i."'>".$i."</a></li>";
            }
        }
        ?>
        <li>
          <a href="index.php?path=pages/alumni/search_alumni&query=<?php echo $query; ?>&page=<?php if($page < $pages) echo $page + 1; else echo $pages; ?>" aria-label="Next page">
            <span aria-hidden="true">&rsaquo;</span>
          </a>
        </li>
        <li>
          <a href="index.php?path=pages/alumni/search_alumni&query=<?php echo $query; ?>&page=<?php echo $pages; ?>" aria-label="Last page">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
    <?php
    } 
}?>