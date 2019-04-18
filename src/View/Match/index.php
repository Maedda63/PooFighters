<?php

require_once './components/header.php';

?>

        <div class="text-center container-fluid">
            <h2> Matchs en cours </h2>
            <br>
            <button class="btn btn-warning"><a href='/match/createFirstMatches'>Start everything ! </a></button>
            <br>
            <br>
            <h3>Quarts de finale</h3>
            <br>
            <div class="row">
                <?php for ($i=0; $i<4; $i++) { ?>
                <div class="col-3" name="quart-one">
                    <form>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nom de la team</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="border-0 inputSize" type="text" name='score_one'>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input class="border-0 inputSize" type="text" name='score_two'>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-success"> <a href='<?php echo "/Match/index?id=" . $i ?>'>Valider les scores </a> </button>
                    </form>
                </div>
                <?php } ?>
            <br>
            </div>
            <h3>Demi-finales</h3>
            <br>
            <div class="row">
                <div class="col-4 offset-2" name="demi-one">
                    <form>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nom de la team</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input class="border-0 inputSize" type="text">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input class="border-0 inputSize" type="text" >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-success">Valider les scores</button>
                    </form>
                </div>
                <div class="col-4" name="demi-two">
                    <form>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nom de la team</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input class="border-0 inputSize" type="text">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input class="border-0 inputSize" type="text" >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-success">Valider les scores</button>
                    </form>
                </div>
            </div>
            <br>
            <h3>Troisième place</h3>
            <div class="col-6 offset-3" name="thirdPlace">
                <form>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nom de la team</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>
                                    <input class="border-0 inputSize" type="text">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input class="border-0 inputSize" type="text" >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-success">Valider les scores</button>
                </form>
            </div>

            <br>
            <h3>Finale</h3>
            <div class="col-6 offset-3" name="final">
                <form>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nom de la team</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>
                                    <input class="border-0 inputSize" type="text">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input class="border-0 inputSize" type="text" >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-success">Valider les scores</button>
                </form>
            </div>
            <br>
            <br>
            <img src="../public/image/coupe.jpg" style="height: 200px">
            <h2>L'équipe gagnante de ce tournoi est <!--Là il y aura le nom du gagnant de la finale (et ne pas oublier de laisser les espaces entre "est" et "!"--> !</h2>
            <br>
        </div>
    </body>
</html>