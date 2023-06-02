<!-- Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Sidebar Brand -->
  <a href="#" class="brand-link">
    <div class="sidebar-brand-icon">
    </div>
    <div class="sidebar-brand-text mx-3">HRMS System</div>
  </a>

  <!-- Sidebar Menu -->
  <div class="sidebar">
    <!-- Sidebar Menu Items -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" id="sidebarAccordion">
        <!-- Query Menu -->
        <?php
        $role_id = $this->session->userdata('role_id');

        $queryMenu = "SELECT `user_menu`.`id`, `menu`
                      FROM `user_menu` JOIN `user_access`
                        ON `user_menu`.`id` = `user_access`.`menu_id`
                     WHERE `user_access`.`role_id` = $role_id
                  ORDER BY `user_access`.`menu_id` ASC";

        $menu = $this->db->query($queryMenu)->result_array();

        foreach ($menu as $mn) :
          $menuId = $mn['id'];

          $querySubMenu = "SELECT * FROM `user_submenu`
                           WHERE `menu_id` = $menuId 
                             AND `is_active` = 1";

          $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>

            <!-- Submenu -->

      <a class="nav-link" href="#">
        <div class="sidebar-heading">
          <?= $mn['menu']; ?>
        </div>
      </a>
      <?php
      $menuId = $mn['id'];

      $querySubMenu = "SELECT * FROM `user_submenu`
                             WHERE `menu_id` = $menuId 
                               AND `is_active` = 1";

      $subMenu = $this->db->query($querySubMenu)->result_array();

      foreach ($subMenu as $sm) :
        if ($title == $sm['title']) :
      ?>
          <a class="nav-link pb-0 active" href="<?= base_url($sm['url']); ?>">
            <i class="<?= $sm['icon']; ?>"></i>
            <span><?= $sm['title']; ?></span>
          </a>
        <?php else : ?>
          <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
            <i class="<?= $sm['icon']; ?>"></i>
            <span><?= $sm['title']; ?></span>
          </a>
        <?php endif; ?>
      <?php endforeach; ?>
            </ul>
            <!-- End Submenu -->
            <hr class="sidebar-divider mt-3">
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>
    <!-- End Sidebar Menu Items -->
  </div>
  <!-- End Sidebar Menu -->
</aside>
<!-- End of Sidebar -->
