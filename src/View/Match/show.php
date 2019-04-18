<?php

require_once './components/header.php';

?>

        <div class="text-center container-fluid">
            <h2> Matchs en cours </h2>
            <br>
            <button class="btn btn-primary"><a href='/match/doEverything'>Générer le tournoi</a></button>
            <br>
            
                <?php if ($this->errors) {
                    foreach ($this->errors as $error) { ?>
                        <div class='alert alert-danger m-4'>
                        <?php echo $error; ?>
                        </div>
                    <?php }
                } else { ?> 
            
            <br>
            <h3>Quarts de finale</h3>
            <br>
            <div class="row">
                <?php for ($i=0; $i<4; $i++) { ?>
                <div class="col-3" name="quart-one">
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
                                    <?php echo $this->teamRepository->getTeam('WHERE team_id =' . 
                                        $this->matchRepository->getMatch('WHERE match_id =' . 
                                        $currentMatches[$i]->getId())->getTeamOne())->getName() ?>
                                </td>
                                <td>
                                <?php echo $this->matchRepository->getMatch('WHERE match_id =' . 
                                    $currentMatches[$i]->getId())->getResultOne()   ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo $this->teamRepository->getTeam('WHERE team_id =' . 
                                        $this->matchRepository->getMatch('WHERE match_id =' . 
                                        $currentMatches[$i]->getId())->getTeamTwo())->getName()   ?>
                                </td>
                                <td>
                                    <?php echo $this->matchRepository->getMatch('WHERE match_id =' . 
                                        $currentMatches[$i]->getId())->getResultTwo() ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php } ?>
            </div>
            <br>
            <h3>Demi-finales</h3>
            <br> 
            <div class="row">
            <?php for ($j=0; $j < 2; $j++) { ?>
                <div class="col-4 offset-1" name="demi-one">
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
                                    <?php echo $this->teamRepository->getTeam('WHERE team_id =' . 
                                        $this->matchRepository->getMatch('WHERE match_id =' . 
                                        $currentSemiMatches[$j]->getId())->getTeamOne())->getName() ?>
                                </td>
                                <td>
                                    <?php echo $this->matchRepository->getMatch('WHERE match_id =' . 
                                        $currentSemiMatches[$j]->getId())->getResultOne() ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo $this->teamRepository->getTeam('WHERE team_id =' . 
                                        $this->matchRepository->getMatch('WHERE match_id =' . 
                                        $currentSemiMatches[$j]->getId())->getTeamTwo())->getName() ?>
                                </td>
                                <td>
                                    <?php echo $this->matchRepository->getMatch('WHERE match_id =' . 
                                        $currentSemiMatches[$j]->getId())->getResultTwo() ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
            </div>
            <br>
            <h3>Troisième place</h3>
            <br>
            <div class="col-6 offset-3" name="thirdPlace">
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
                            <?php echo $this->teamRepository->getTeam('WHERE team_id =' . 
                                    $this->matchRepository->getMatch('WHERE match_id =' . 
                                    $finals[1]->getId())->getTeamOne())->getName() ?>
                            </td>
                            <td>
                                <?php echo $this->matchRepository->getMatch('WHERE match_id =' . 
                                    $finals[1]->getId())->getResultOne() ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo $this->teamRepository->getTeam('WHERE team_id =' . 
                                    $this->matchRepository->getMatch('WHERE match_id =' . 
                                    $finals[1]->getId())->getTeamTwo())->getName() ?>
                            </td>
                            <td>
                                <?php echo $this->matchRepository->getMatch('WHERE match_id =' . 
                                    $finals[1]->getId())->getResultTwo() ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <h3>Finale</h3>
            <br>
            <div class="col-6 offset-3" name="final">
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
                                <?php echo $this->teamRepository->getTeam('WHERE team_id =' . 
                                    $this->matchRepository->getMatch('WHERE match_id =' . 
                                    $finals[0]->getId())->getTeamOne())->getName() ?>
                            </td>
                            <td>
                                <?php echo $this->matchRepository->getMatch('WHERE match_id =' . 
                                    $finals[0]->getId())->getResultOne() ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo $this->teamRepository->getTeam('WHERE team_id =' . 
                                    $this->matchRepository->getMatch('WHERE match_id =' . 
                                    $finals[0]->getId())->getTeamTwo())->getName() ?>
                            </td>
                            <td>
                                <?php echo $this->matchRepository->getMatch('WHERE match_id =' . 
                                    $finals[0]->getId())->getResultTwo() ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <br>
            <img src="../public/image/coupe.png" style="height: 200px">
            <br>
            <br>
            <h2>L'équipe gagnante de ce tournoi est <b> <?php echo ' ' . $winner . ' ' ?> </b>  !</h2>
            <br>
        </div>
            <?php } ?>
    </body>
</html>