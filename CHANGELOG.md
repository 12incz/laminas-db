# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 2.5.2 - 2015-09-22

### Added

- Nothing.

### Deprecated

- Nothing.

### Removed

- [zendframework/zend-db#29](https://github.com/zendframework/zend-db/pull/29) removes the required
  second argument to `Laminas\Db\Predicate\Predicate::expression()`, allowing it to
  be nullable, and mirroring the constructor of `Laminas\Db\Predicate\Expression`.

### Fixed

- [zendframework/zend-db#40](https://github.com/zendframework/zend-db/pull/40) updates the
  laminas-stdlib dependency to reference `>=2.5.0,<2.7.0` to ensure hydrators
  will work as expected following extraction of hydrators to the laminas-hydrator
  repository.
- [zendframework/zend-db#34](https://github.com/zendframework/zend-db/pull/34) fixes retrieval of
  constraint metadata in the Oracle adapter.
- [zendframework/zend-db#41](https://github.com/zendframework/zend-db/pull/41) removes hard dependency
  on EventManager in AbstractTableGateway.
- [zendframework/zend-db#17](https://github.com/zendframework/zend-db/pull/17) removes an executable
  bit on a regular file.
- [zendframework/zend-db#3](https://github.com/zendframework/zend-db/pull/3) updates the code to use
  closure binding (now that we're on 5.5+, this is possible).
- [zendframework/zend-db#9](https://github.com/zendframework/zend-db/pull/9) thoroughly audits the
  OCI8 (Oracle) driver, ensuring it provides feature parity with other drivers,
  and fixes issues with subselects, limits, and offsets.
