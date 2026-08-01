<?php

// Blog routes are being rewritten for Prezet v1 (the old package shipped the
// Index/Show/Image/Ogimage controllers; v1 does not). Temporarily empty so the
// app boots during the migration; the cache-safe blog routes (prezet.index /
// prezet.show / prezet.image / prezet.ogimage, with cache.headers:public;max_age=0;etag
// and the cookie-stripped middleware) are restored once the v1 render path is wired.
