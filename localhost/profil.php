<?php 
include 'header.php';



if ($userId) {
    $query = $conn->prepare("SELECT email, name, vorname, geburtsdatum, gewicht, geschlecht FROM user WHERE id = :userId");
    $query->bindParam(':userId', $userId, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $vorname = $_POST['vorname'];
        $geburtsdatum = $_POST['geburtsdatum'];
        $gewicht = $_POST['gewicht'];
        $geschlecht = $_POST['geschlecht'];

        $sql = "UPDATE user SET email=:email, name=:name, vorname=:vorname, geburtsdatum=:geburtsdatum, gewicht=:gewicht, geschlecht=:geschlecht WHERE id=:userId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':vorname', $vorname);
        $stmt->bindParam(':geburtsdatum', $geburtsdatum);
        $stmt->bindParam(':gewicht', $gewicht, PDO::PARAM_INT);
        $stmt->bindParam(':geschlecht', $geschlecht);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

        $updateSuccessful = false;

        if ($stmt->execute()) {
            $updateSuccessful = true;
        } 
        
        
        if ($updateSuccessful) {
            echo "<script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', function() {
                        var modal = document.getElementById('modal');
                        var closeModal = document.getElementById('close-modal');
                        
                        if(modal && closeModal) {
                            modal.style.display = 'block';
        
                            closeModal.addEventListener('click', function() {
                                modal.style.display = 'none';
                            });
        
                            window.addEventListener('click', function(event) {
                                if (event.target == modal) {
                                    modal.style.display = 'none';
                                }
                            });
                        }
                    });
                  </script>";
        }else {
            echo "Fehler: " . $stmt->errorInfo()[2];
        }
        
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
    }
} else {
    echo "Benutzer nicht angemeldet.";
    exit;
}

$email = $result['email'];
$name = $result['name'];
$vorname = $result['vorname'];
$geburtsdatum = $result['geburtsdatum'];
$gewicht = $result['gewicht'];
$geschlecht = $result['geschlecht'];
?>



<form id="profil-form" action="profil.php" method="post">
    <label for="email">E-Mail:</label>
    <input type="text" id="email" name="email"  value="<?php echo htmlspecialchars($email); ?>">

    <label for="name">Name:</label>
    <input type="text" id="name" name="name"  value="<?php echo htmlspecialchars($name ?? ''); ?>">


    <label for="vorname">Vorname:</label>
    <input type="text" id="vorname" name="vorname"  value="<?php echo htmlspecialchars($vorname ?? ''); ?>">

    <label for="geburtsdatum">Geburtsdatum:</label>
    <input type="date" id="geburtsdatum" name="geburtsdatum"  value="<?php echo htmlspecialchars($geburtsdatum); ?>">

    <label for="gewicht">Gewicht:</label>
    <input type="number" id="gewicht" name="gewicht"  value="<?php echo htmlspecialchars($gewicht); ?>">

    <label for="geschlecht">Geschlecht:</label>
    <select id="geschlecht" name="geschlecht" >
        <option value="m" <?php echo $geschlecht == 'm' ? 'selected' : ''; ?>>Männlich</option>
        <option value="w" <?php echo $geschlecht == 'w' ? 'selected' : ''; ?>>Weiblich</option>
    </select>

    <div class="container-submit-btn">
        <button class="submit-btn" type="submit" name="register">Profil aktualisieren</button>
    </div>
</form>

<div id="modal" style="display:none;">
    <div id="modal-content">
        <div class="close-container">
            <span id="close-modal">&times;</span>
        </div>
        <p id="modal-message">Profil aktualisiert.</p>
    </div>
</div>


