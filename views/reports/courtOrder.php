<style>
/*    .reportHeading{
        font-size: 20px;
        text-align: center;
    }
    .firstName{
        width: 150px;
    }
    .sirName{
        width: 150px;
    }
    .medicalNote{
        width: 300px;
    }
    .dob{
        width: 120px;
    }
    
    .fatherName{
        width: 150px;
    }
    .motherName{
        width: 150px;
    }
    .courtNote{
        width: 250px;
    }
    .parentGuardian{
        width: 150px;
    }*/
</style>

<?php
$models = $dataProvider->getModels();
?>

<table class="reportTable">
    <tr>
        <th class="reportHeading" colspan="5">
            Court Orders
        </th>
    </tr>
    <tr>
        <th class="reportHeaderRow fatherName">Father's Name</th>
        <th class="reportHeaderRow motherName">Mother's Name</th>
        <th class="reportHeaderRow courtNote">Court Order Note</th>
        <th class="reportHeaderRow parentGuardian">Parent/Guardian</th>
        <th class="reportHeaderRow children">Children</th>

    </tr>
<?php
foreach ($models as $index => $model){
    $oddeven = ($index % 2)?'oddRow':'evenRow';
    ?>
    <tr>
        <td class='<?= $oddeven; ?>'><?= $model->fatherFullName; ?></td>
        <td class='<?= $oddeven; ?>'><?= $model->motherFullName; ?></td>
        <td class='<?= $oddeven; ?>'><?= $model->pg_court_order_note; ?></td>
        <td class='<?= $oddeven; ?>'><?= $model->pg_name_parent_guardian; ?></td>
        <td class='<?= $oddeven; ?>'><?= $model->listOfChildren; ?></td>
 
    </tr>
    <?php
}
?>
    
</table>