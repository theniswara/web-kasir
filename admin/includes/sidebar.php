        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.php" class="app-brand-link">
              <span class="app-brand-logo demo">
                <span class="text-primary">
                  <svg
                      xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                      <g fill="currentColor">
                      <path d="M1 0a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h5v1H2v2h6V9H2V2h10v4h2V1a1 1 0 0 0-1-1z" />
                      <path d="M10 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1zm1 7V9h3v5z" />
                      </g>
                  </svg>
                </span>
              </span>
              <span class="app-brand-text demo menu-text fw-bold ms-2">GadgetIn</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="bx bx-chevron-left d-block d-xl-none align-middle"></i>
            </a>
          </div>

          <div class="menu-divider mt-0"></div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Core</span>
            </li>
            <!-- Dashboards -->
            <li class="menu-item active">
              <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home"></i>
                <div class="text-truncate" data-i18n="Dashboards">Dashboards</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="buat-pesanan.php" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-create"></i>
                <div class="text-truncate" data-i18n="Dashboards">Buat Pesanan</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="pesanan.php" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-orders"></i>
                <div class="text-truncate" data-i18n="Dashboards">Pesanan</div>
              </a>
            </li>

              <!-- Interface -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Interface</span>
            </li>
            <!-- Pages -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-products"></i>
                <div class="text-truncate" data-i18n="Account Settings">Produk</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="tambah-produk.php" class="menu-link">
                    <div class="text-truncate" data-i18n="AddCategories">Tambah Produk</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="list-produk.php" class="menu-link">
                    <div class="text-truncate" data-i18n="Notifications">List Produk</div>
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Interface</span>
            </li>
            <!-- Pages -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-customer"></i>
                <div class="text-truncate" data-i18n="Account Settings">Pelanggan</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="tambah-pelanggan.php" class="menu-link">
                    <div class="text-truncate" data-i18n="AddCategories">Tambah Pelanggan</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="pages-account-settings-notifications.html" class="menu-link">
                    <div class="text-truncate" data-i18n="Notifications">List Pelanggan</div>
                  </a>
                </li>
              </ul>
            </li>

             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-admin"></i>
                <div class="text-truncate" data-i18n="Account Settings">Admin</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="tambah-admin.php" class="menu-link">
                    <div class="text-truncate" data-i18n="AddCategories">Tambah Admin</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="list-admin.php" class="menu-link">
                    <div class="text-truncate" data-i18n="Notifications">List Admin</div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->