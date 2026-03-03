# Authenticating requests

To authenticate requests, include an **`Authorization`** header with the value **`"Bearer {YOUR_AUTH_TOKEN}"`**.

All authenticated endpoints are marked with a `requires authentication` badge in the documentation below.

Obtain a token via <code>POST /api/v1/login</code>. Include it in all protected requests as:<br><br><code>Authorization: Bearer {token}</code>
