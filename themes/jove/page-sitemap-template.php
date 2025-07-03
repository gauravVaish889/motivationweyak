<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <title>XML Sitemap</title>
      <style>
          body {
              font-family: Arial, sans-serif;
              margin: 0;
              background: #f5f5f5;
              color: #333;
          }
          .header {
              background: #3474f7;
              color: white;
              padding: 20px 40px;
          }
          .header h1 {
              margin: 0;
              font-size: 28px;
              font-weight: 600;
          }
          .header p {
              margin-top: 8px;
              font-size: 14px;
              color: rgba(255,255,255,0.9);
          }
          .header a {
              color: #ffffff;
              text-decoration: underline;
          }
          .container {
              padding: 30px 40px;
          }
          h2 {
              font-size: 18px;
              margin-bottom: 20px;
          }
          .sitemap-table {
              width: 100%;
              border-collapse: collapse;
              background: #fff;
              box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
          }
          .sitemap-table thead {
              background: #3474f7;
              color: white;
          }
          .sitemap-table th,
          .sitemap-table td {
              padding: 12px 16px;
              border-bottom: 1px solid #ddd;
              font-size: 14px;
          }
          .sitemap-table tr:nth-child(even) {
              background-color: #f9f9f9;
          }
          .sitemap-table a {
              color: #0073aa;
              text-decoration: none;
          }
          .sitemap-table a:hover {
              text-decoration: underline;
          }
      </style>
  </head>
  <body>
      <div class="header">
          <h1>XML Sitemap</h1>
          <p>This XML Sitemap Index file contains <?php echo $total_sitemaps; ?> sitemaps.</p>
      </div>
      <div class="container">
          <table class="sitemap-table">
              <thead>
                  <tr>
                      <th>Sitemap</th>
                      <th>Last Modified</th>
                  </tr>
              </thead>
              <tbody>
                  <?php for ($i = 1; $i <= $total_sitemaps; $i++): ?>
                      <tr>
                          <td>
                              <a href="<?php echo esc_url($base . "page-sitemap{$i}.xml"); ?>">
                                  <?php echo esc_html($base . "page-sitemap{$i}.xml"); ?>
                              </a>
                          </td>
                          <td><?php echo esc_html(date('Y-m-d H:i:s O')); ?></td>
                      </tr>
                  <?php endfor; ?>
              </tbody>
          </table>
      </div>
  </body>
  </html>