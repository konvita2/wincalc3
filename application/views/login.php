<? $this->load->helper('url'); ?>

<? $this->load->view('main_topmost'); ?>

<!DOCTYPE html>
<html lang="en">

<?
$data['tit'] = 'Логин';
$this->load->view('main_head', $data);
?>

<body>

<? $this->load->view('main_navbar'); ?>

    <div class="container">



    </div>

</body>
</html>
