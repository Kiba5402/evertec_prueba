<?php

namespace Tests\Traits;

use Illuminate\Support\Facades\DB;

trait TransactionForTesting
{
	public function setUp(): void
	{
		parent::setUp();
		DB::beginTransaction();
	}

	public function tearDown(): void
	{
		DB::rollback();
		parent::tearDown();
	}
}
