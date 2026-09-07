<?php
/**
 * Warehouse Core — local dashboard
 * -------------------------------------------------------------
 * A thin web front-end over ShellFacade. Every action on this page
 * is a 1:1 call to a ShellFacade method — nothing here talks to the
 * database directly.
 *
 * SETUP:
 *   1. Adjust the autoload path below if this file does not live
 *      one level under your project root (e.g. project/public/index.php).
 *   2. Run:  php -S localhost:8000 -t public
 *   3. Open http://localhost:8000
 *
 * This dashboard re-authenticates as 'root' on every request, same
 * as a fresh Shell invocation would. No session-persisted API object.
 */

declare(strict_types=1);

// ---------------------------------------------------------------
// Bootstrap
// ---------------------------------------------------------------

$autoload = __DIR__ . '/../vendor/autoload.php';

if (!file_exists($autoload)) {
    http_response_code(500);
    render_setup_notice($autoload);
    exit;
}

require $autoload;

use WarehouseCore\Facade\ShellFacade;

session_start();
if (!isset($_SESSION['log'])) {
    $_SESSION['log'] = [];
}
if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(16));
}

// ---------------------------------------------------------------
// Action registry — mirrors ShellFacade's public surface.
// 'fields' order must match the facade method's parameter order.
// ---------------------------------------------------------------

$ROLES     = ['Admin', 'Worker', 'Salesman', 'Viewer'];
$PROVIDERS = ['Shell', 'Web', 'Telegram'];

$DOMAINS = [
    'overview' => [
        'label' => 'Overview',
        'code'  => '00',
        'actions' => [],
    ],
    'area' => [
        'label' => 'Area',
        'code'  => 'AR',
        'actions' => [
            'createArea' => [
                'label' => 'Create area', 'method' => 'createArea', 'fields' => [],
            ],
            'activateArea' => [
                'label' => 'Activate area', 'method' => 'activateArea',
                'fields' => [f('area_id', 'int', 'Area ID')],
            ],
            'markAreaAsCrowded' => [
                'label' => 'Mark as crowded', 'method' => 'markAreaAsCrowded',
                'fields' => [f('area_id', 'int', 'Area ID')],
            ],
            'archiveArea' => [
                'label' => 'Archive area', 'method' => 'archiveArea',
                'fields' => [f('area_id', 'int', 'Area ID')],
                'destructive' => true,
                'confirm' => 'Archiving an area is permanent — it cannot return to an earlier state. Continue?',
            ],
            'grantAreaAccess' => [
                'label' => 'Grant access', 'method' => 'grantAreaAccess',
                'fields' => [f('area_id', 'int', 'Area ID'), f('user_id', 'int', 'User ID')],
            ],
            'revokeAreaAccess' => [
                'label' => 'Revoke access', 'method' => 'revokeAreaAccess',
                'fields' => [f('area_id', 'int', 'Area ID'), f('user_id', 'int', 'User ID')],
            ],
            'addAreaName' => [
                'label' => 'Add name', 'method' => 'addAreaName',
                'fields' => [f('area_id', 'int', 'Area ID'), f('name', 'string', 'Name')],
            ],
            'setPrimaryAreaName' => [
                'label' => 'Set primary name', 'method' => 'setPrimaryAreaName',
                'fields' => [f('area_id', 'int', 'Area ID'), f('record_id', 'int', 'Name record ID')],
            ],
            'removeAreaName' => [
                'label' => 'Remove name', 'method' => 'removeAreaName',
                'fields' => [f('area_id', 'int', 'Area ID')],
            ],
            'listAreaNames' => [
                'label' => 'List names', 'method' => 'listAreaNames',
                'fields' => [f('area_id', 'int', 'Area ID')],
                'readonly' => true,
            ],
            'listArea' => [
                'label' => 'List all areas', 'method' => 'listArea',
                'fields' => [], 'readonly' => true,
            ],
        ],
    ],
    'zone' => [
        'label' => 'Zone',
        'code'  => 'ZN',
        'actions' => [
            'createZone' => [
                'label' => 'Create zone in area', 'method' => 'createZone',
                'fields' => [f('area_id', 'int', 'Parent area ID')],
            ],
            'activateZone' => [
                'label' => 'Activate zone', 'method' => 'activateZone',
                'fields' => [f('zone_id', 'int', 'Zone ID')],
            ],
            'markZoneAsCrowded' => [
                'label' => 'Mark as crowded', 'method' => 'markZoneAsCrowded',
                'fields' => [f('zone_id', 'int', 'Zone ID')],
            ],
            'archiveZone' => [
                'label' => 'Archive zone', 'method' => 'archiveZone',
                'fields' => [f('zone_id', 'int', 'Zone ID')],
                'destructive' => true,
                'confirm' => 'Archiving a zone is permanent — it cannot return to an earlier state. Continue?',
            ],
            'addZoneName' => [
                'label' => 'Add name', 'method' => 'addZoneName',
                'fields' => [f('zone_id', 'int', 'Zone ID'), f('name', 'string', 'Name')],
            ],
            'setPrimaryZoneName' => [
                'label' => 'Set primary name', 'method' => 'setPrimaryZoneName',
                'fields' => [f('zone_id', 'int', 'Zone ID'), f('record_id', 'int', 'Name record ID')],
            ],
            'removeZoneName' => [
                'label' => 'Remove name', 'method' => 'removeZoneName',
                'fields' => [f('zone_id', 'int', 'Zone ID')],
            ],
            'listZoneByArea' => [
                'label' => 'List zones in area', 'method' => 'listZoneByArea',
                'fields' => [f('area_id', 'int', 'Area ID')],
                'readonly' => true,
            ],
        ],
    ],
    'user' => [
        'label' => 'User',
        'code'  => 'US',
        'actions' => [
            'createUser' => [
                'label' => 'Create user', 'method' => 'createUser', 'fields' => [],
            ],
            'activateUser' => [
                'label' => 'Activate user', 'method' => 'activateUser',
                'fields' => [f('user_id', 'int', 'User ID')],
            ],
            'archiveUser' => [
                'label' => 'Archive user', 'method' => 'archiveUser',
                'fields' => [f('user_id', 'int', 'User ID')],
                'destructive' => true,
                'confirm' => 'Archiving a user is permanent — it cannot return to an earlier state. Continue?',
            ],
            'assignUserRole' => [
                'label' => 'Assign role', 'method' => 'assignUserRole',
                'fields' => [f('user_id', 'int', 'User ID'), f('role', 'select', 'Role', $ROLES)],
            ],
            'dismissUserRole' => [
                'label' => 'Dismiss role', 'method' => 'dismissUserRole',
                'fields' => [f('user_id', 'int', 'User ID')],
            ],
            'addUserName' => [
                'label' => 'Add name', 'method' => 'addUserName',
                'fields' => [f('user_id', 'int', 'User ID'), f('name', 'string', 'Name')],
            ],
            'setPrimaryUserName' => [
                'label' => 'Set primary name', 'method' => 'setPrimaryUserName',
                'fields' => [f('user_id', 'int', 'User ID'), f('record_id', 'int', 'Name record ID')],
            ],
            'removeUserName' => [
                'label' => 'Remove name', 'method' => 'removeUserName',
                'fields' => [f('user_id', 'int', 'User ID')],
            ],
            'addUserIdentity' => [
                'label' => 'Add identity', 'method' => 'addUserIdentity',
                'fields' => [
                    f('user_id', 'int', 'User ID'),
                    f('provider', 'select', 'Provider', $PROVIDERS),
                    f('external_id', 'string', 'External ID'),
                ],
            ],
            'removeUserIdentity' => [
                'label' => 'Remove identity', 'method' => 'removeUserIdentity',
                'fields' => [f('user_id', 'int', 'User ID'), f('provider', 'select', 'Provider', $PROVIDERS)],
            ],
            'listUserIdentities' => [
                'label' => 'List identities', 'method' => 'listUserIdentities',
                'fields' => [f('user_id', 'int', 'User ID')], 'readonly' => true,
            ],
            'listUserNames' => [
                'label' => 'List names', 'method' => 'listUserNames',
                'fields' => [f('user_id', 'int', 'User ID')], 'readonly' => true,
            ],
            'listUser' => [
                'label' => 'List all users', 'method' => 'listUser',
                'fields' => [], 'readonly' => true,
            ],
        ],
    ],
    'rack' => [
        'label' => 'Rack',
        'code'  => 'RK',
        'actions' => [
            'registerRack' => [
                'label' => 'Register rack', 'method' => 'registerRack', 'fields' => [],
            ],
            'populateRack' => [
                'label' => 'Populate rack', 'method' => 'populateRack',
                'fields' => [f('rack_id', 'int', 'Rack ID'), f('count', 'int', 'Shelf / slot count')],
            ],
        ],
    ],
];

function f(string $name, string $type, string $label, array $options = []): array {
    return compact('name', 'type', 'label', 'options');
}

// ---------------------------------------------------------------
// Request handling
// ---------------------------------------------------------------

$domainKey = $_GET['domain'] ?? 'overview';
if (!isset($DOMAINS[$domainKey])) {
    $domainKey = 'overview';
}

$actionKeys = array_keys($DOMAINS[$domainKey]['actions']);
$actionKey  = $_GET['action'] ?? ($actionKeys[0] ?? null);
if ($actionKey !== null && !isset($DOMAINS[$domainKey]['actions'][$actionKey])) {
    $actionKey = $actionKeys[0] ?? null;
}

$facade = ShellFacade::create();
$auth   = $facade->authenticate();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postDomain = $_POST['__domain'] ?? '';
    $postAction = $_POST['__action'] ?? '';
    $token      = $_POST['__csrf'] ?? '';

    if (!hash_equals($_SESSION['csrf'], $token)) {
        $_SESSION['log'][] = [
            'ts' => time(), 'domain' => $postDomain, 'action' => $postAction,
            'args' => [], 'ok' => false, 'output' => 'Rejected: invalid or expired form token.',
        ];
    } elseif (isset($DOMAINS[$postDomain]['actions'][$postAction])) {
        $config = $DOMAINS[$postDomain]['actions'][$postAction];
        $args   = [];
        $argsForLog = [];

        foreach ($config['fields'] as $field) {
            $raw = $_POST[$field['name']] ?? '';
            $val = $field['type'] === 'int' ? (int)$raw : (string)$raw;
            $args[] = $val;
            $argsForLog[$field['name']] = $val;
        }

        try {
            $output = call_user_func_array([$facade, $config['method']], $args);
            $_SESSION['log'][] = [
                'ts' => time(), 'domain' => $postDomain, 'action' => $postAction,
                'args' => $argsForLog, 'ok' => true, 'output' => strip_ansi($output),
            ];
        } catch (\Throwable $e) {
            $_SESSION['log'][] = [
                'ts' => time(), 'domain' => $postDomain, 'action' => $postAction,
                'args' => $argsForLog, 'ok' => false, 'output' => $e->getMessage(),
            ];
        }
    }

    header('Location: ?domain=' . urlencode($postDomain) . '&action=' . urlencode($postAction));
    exit;
}

$overviewAreas = $overviewUsers = null;
if ($domainKey === 'overview') {
    try { $overviewAreas = strip_ansi($facade->listArea()); } catch (\Throwable $e) { $overviewAreas = $e->getMessage(); }
    try { $overviewUsers = strip_ansi($facade->listUser()); } catch (\Throwable $e) { $overviewUsers = $e->getMessage(); }
}

function strip_ansi(string $s): string {
    return preg_replace('/\x1b\[[0-9;]*m/', '', $s) ?? $s;
}

function e(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function render_setup_notice(string $path): void {
    echo '<!doctype html><html><head><meta charset="utf-8"><title>Warehouse Core — setup needed</title>'
       . '<style>body{background:#14161A;color:#E6E4DF;font:15px/1.6 -apple-system,sans-serif;max-width:640px;margin:80px auto;padding:0 24px}'
       . 'code{background:#1E2126;padding:2px 6px;border-radius:3px;color:#D8A32B}</style></head><body>'
       . '<h1 style="font-weight:600">Autoload not found</h1>'
       . '<p>This dashboard expects the Warehouse Core autoloader at:</p>'
       . '<p><code>' . e($path) . '</code></p>'
       . '<p>Edit the <code>$autoload</code> path near the top of this file to match your project layout, then reload.</p>'
       . '</body></html>';
}

$currentDomain = $DOMAINS[$domainKey];
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Warehouse Core — dashboard</title>
<style>
  :root{
    --bg:#14161A; --panel:#1B1E23; --panel-alt:#181B20; --border:#2A2E35;
    --text:#E6E4DF; --text-dim:#8B8F97;
    --amber:#D8A32B; --amber-dim:#8A6B24;
    --green:#4F8F6B; --red:#B24A3C; --blue:#4A7FA8;
    --mono: ui-monospace, "SF Mono", "Cascadia Code", Menlo, Consolas, monospace;
    --sans: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  }
  *{box-sizing:border-box}
  body{margin:0;background:var(--bg);color:var(--text);font-family:var(--sans);font-size:14.5px}
  a{color:inherit}

  .shell{display:grid;grid-template-columns:184px 1fr 380px;min-height:100vh}
  @media (max-width:980px){ .shell{grid-template-columns:1fr} }

  /* status bar */
  .statusbar{grid-column:1/-1;display:flex;align-items:center;gap:10px;
    padding:12px 20px;border-bottom:1px solid var(--border);background:var(--panel-alt)}
  .dot{width:8px;height:8px;border-radius:50%;background:var(--green);
    box-shadow:0 0 0 0 rgba(79,143,107,.6);animation:pulse 2.4s infinite}
  @keyframes pulse{
    0%{box-shadow:0 0 0 0 rgba(79,143,107,.5)}
    70%{box-shadow:0 0 0 6px rgba(79,143,107,0)}
    100%{box-shadow:0 0 0 0 rgba(79,143,107,0)}
  }
  .statusbar .brand{font-weight:600;letter-spacing:.2px}
  .statusbar .sep{color:var(--border)}
  .statusbar .who{color:var(--text-dim);font-family:var(--mono);font-size:13px}

  /* nav rail */
  .rail{border-right:1px solid var(--border);padding:14px 0;background:var(--panel-alt)}
  .rail a{display:flex;align-items:center;gap:10px;padding:10px 18px;text-decoration:none;
    color:var(--text-dim);border-left:2px solid transparent}
  .rail a:hover{color:var(--text)}
  .rail a.active{color:var(--text);border-left-color:var(--amber);background:rgba(216,163,43,.07)}
  .rail .chip{font-family:var(--mono);font-size:11px;color:var(--amber);border:1px solid var(--amber-dim);
    border-radius:3px;padding:1px 5px;min-width:22px;text-align:center}
  @media (max-width:980px){
    .rail{display:flex;overflow-x:auto;padding:8px 10px;border-right:0;border-bottom:1px solid var(--border)}
    .rail a{padding:8px 12px;white-space:nowrap;border-left:0;border-bottom:2px solid transparent}
    .rail a.active{border-left:0;border-bottom-color:var(--amber)}
  }

  /* main */
  .main{padding:24px 28px;min-width:0}
  .main h1{font-size:20px;margin:0 0 4px;font-weight:600}
  .main .sub{color:var(--text-dim);margin:0 0 22px;font-size:13.5px}

  .pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:22px}
  .pill{padding:6px 13px;border-radius:16px;border:1px solid var(--border);color:var(--text-dim);
    text-decoration:none;font-size:13px}
  .pill.active{background:var(--amber);border-color:var(--amber);color:#1B1E23;font-weight:600}
  .pill.destructive.active{background:var(--red);border-color:var(--red);color:#F4E9E6}

  .card{background:var(--panel);border:1px solid var(--border);border-radius:6px;padding:20px}
  .field{margin-bottom:14px}
  .field label{display:block;font-size:12.5px;color:var(--text-dim);margin-bottom:5px}
  .field input, .field select{
    width:100%;padding:9px 10px;background:var(--panel-alt);border:1px solid var(--border);
    border-radius:4px;color:var(--text);font-family:var(--sans);font-size:14px}
  .field input:focus, .field select:focus{outline:2px solid var(--amber);outline-offset:1px;border-color:var(--amber)}

  .btn{appearance:none;border:1px solid var(--amber);background:var(--amber);color:#1B1E23;
    font-weight:600;padding:9px 18px;border-radius:4px;cursor:pointer;font-size:14px}
  .btn:hover{filter:brightness(1.06)}
  .btn.danger{background:var(--red);border-color:var(--red);color:#F4E9E6}
  .btn.ghost{background:transparent;color:var(--text);border-color:var(--border)}

  .empty-note{color:var(--text-dim);font-size:13.5px}
  .overview-grid{display:grid;gap:16px}
  .overview-grid h2{font-size:14px;margin:0 0 8px;color:var(--text-dim);font-weight:500}

  pre.out{margin:0;white-space:pre-wrap;word-break:break-word;font-family:var(--mono);
    font-size:12.5px;line-height:1.5;color:var(--text)}

  /* console */
  .console{border-left:1px solid var(--border);background:var(--panel-alt);
    display:flex;flex-direction:column;min-height:100vh}
  .console-head{padding:14px 18px;border-bottom:1px solid var(--border);
    font-family:var(--mono);font-size:12.5px;color:var(--text-dim)}
  .console-body{padding:14px 18px;overflow-y:auto;flex:1}
  .log-entry{border-left:2px solid var(--green);padding:8px 0 8px 12px;margin-bottom:10px}
  .log-entry.err{border-left-color:var(--red)}
  .log-entry .meta{font-family:var(--mono);font-size:11.5px;color:var(--text-dim);margin-bottom:4px}
  .log-entry .cmd{font-family:var(--mono);font-size:12.5px;color:var(--amber);margin-bottom:5px}
  @media (max-width:980px){ .console{min-height:auto;border-left:0;border-top:1px solid var(--border)} }
</style>
</head>
<body>
<div class="shell">

  <div class="statusbar">
    <span class="dot"></span>
    <span class="brand">Warehouse Core</span>
    <span class="sep">/</span>
    <span class="who">root · shell</span>
  </div>

  <nav class="rail">
    <?php foreach ($DOMAINS as $key => $d): ?>
      <a href="?domain=<?= e($key) ?>" class="<?= $key === $domainKey ? 'active' : '' ?>">
        <span class="chip"><?= e($d['code']) ?></span> <?= e($d['label']) ?>
      </a>
    <?php endforeach; ?>
  </nav>

  <main class="main">
    <?php if ($domainKey === 'overview'): ?>
      <h1>Overview</h1>
      <p class="sub">Current areas and users, read directly through the facade.</p>
      <div class="overview-grid">
        <div class="card">
          <h2>Areas</h2>
          <pre class="out"><?= e($overviewAreas ?? '') ?></pre>
        </div>
        <div class="card">
          <h2>Users</h2>
          <pre class="out"><?= e($overviewUsers ?? '') ?></pre>
        </div>
      </div>

    <?php else: ?>
      <h1><?= e($currentDomain['label']) ?></h1>
      <p class="sub">Actions map one-to-one onto ShellFacade methods.</p>

      <div class="pills">
        <?php foreach ($currentDomain['actions'] as $key => $a): ?>
          <a class="pill <?= ($a['destructive'] ?? false) ? 'destructive' : '' ?> <?= $key === $actionKey ? 'active' : '' ?>"
             href="?domain=<?= e($domainKey) ?>&action=<?= e($key) ?>"><?= e($a['label']) ?></a>
        <?php endforeach; ?>
      </div>

      <?php if ($actionKey !== null): $action = $currentDomain['actions'][$actionKey]; ?>
        <div class="card">
          <form method="post" onsubmit="<?= ($action['confirm'] ?? null) ? "return confirm(".htmlspecialchars(json_encode($action['confirm']), ENT_QUOTES).")" : '' ?>">
            <input type="hidden" name="__domain" value="<?= e($domainKey) ?>">
            <input type="hidden" name="__action" value="<?= e($actionKey) ?>">
            <input type="hidden" name="__csrf" value="<?= e($_SESSION['csrf']) ?>">

            <?php if (empty($action['fields'])): ?>
              <p class="empty-note">No input needed — this call takes no parameters.</p>
            <?php endif; ?>

            <?php foreach ($action['fields'] as $field): ?>
              <div class="field">
                <label for="<?= e($field['name']) ?>"><?= e($field['label']) ?></label>
                <?php if ($field['type'] === 'select'): ?>
                  <select name="<?= e($field['name']) ?>" id="<?= e($field['name']) ?>">
                    <?php foreach ($field['options'] as $opt): ?>
                      <option value="<?= e($opt) ?>"><?= e($opt) ?></option>
                    <?php endforeach; ?>
                  </select>
                <?php else: ?>
                  <input type="<?= $field['type'] === 'int' ? 'number' : 'text' ?>"
                         name="<?= e($field['name']) ?>" id="<?= e($field['name']) ?>" required>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>

            <button class="btn <?= ($action['destructive'] ?? false) ? 'danger' : '' ?>" type="submit">
              <?= e($action['label']) ?>
            </button>
          </form>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </main>

  <aside class="console">
    <div class="console-head">session log — <?= count($_SESSION['log']) ?> call<?= count($_SESSION['log']) === 1 ? '' : 's' ?></div>
    <div class="console-body">
      <?php if (empty($_SESSION['log'])): ?>
        <p class="empty-note">Nothing run yet this session.</p>
      <?php endif; ?>
      <?php foreach (array_reverse($_SESSION['log']) as $entry): ?>
        <div class="log-entry <?= $entry['ok'] ? '' : 'err' ?>">
          <div class="meta"><?= date('H:i:s', $entry['ts']) ?></div>
          <div class="cmd">$ <?= e($entry['domain'] . '.' . $entry['action']) ?><?php foreach ($entry['args'] as $k => $v): ?> <?= e($k) ?>=<?= e((string)$v) ?><?php endforeach; ?></div>
          <pre class="out"><?= e($entry['output']) ?></pre>
        </div>
      <?php endforeach; ?>
    </div>
  </aside>

</div>
</body>
</html>
