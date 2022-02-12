 <!-- Content Header (Page header) -->
 <section class="content-header p-2">
     <?php if (session()->getFlashdata("notifikasi")) { ?>
         <div class="flash-data" data-statusflashdata="<?= session()->getFlashdata("notifikasi")["status"]; ?>" data-msgflashdata="<?= session()->getFlashdata("notifikasi")["msg"]; ?>">
         </div>
     <?php } ?>
     <!-- <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-12">
                 <?php if (isset($title)) { ?>
                     <h1><?= $title; ?></h1>
                 <?php } ?>
             </div>
             <?php if (isset($subtitle)) { ?>
                 <div class="col-sm-12 mt-2">
                     <div class="bg-white p-2 rounded shadow text-wrap font-weight-bold text-justify">
                         <?= $subtitle; ?>
                     </div>
                 </div>
             <?php } ?>
         </div>
     </div> -->
 </section>