<?php
declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;

$namespaceDefinition
use $useClassName;

final class $className extends $baseClassName
{
	public function up()
	{
		$this->schema->create('', function (Blueprint $table) {
			//
		});

		$this->schema->table('', function (Blueprint $table) {
			//
		});
	}

	public function down()
	{
		$this->schema->table('', function (Blueprint $table) {
			//
		});

		$this->schema->drop('');
	}
}
