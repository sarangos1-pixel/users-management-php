<?php

declare(strict_types=1);

final class ClassLoader
{
    /**
     * @var array<string, string>
     */
    private static array $classMap = array(
        'InvalidUserEmailException' => 'Domain/Exceptions/InvalidUserEmailException.php',
        'InvalidUserIdException' => 'Domain/Exceptions/InvalidUserIdException.php',
        'InvalidUserNameException' => 'Domain/Exceptions/InvalidUserNameException.php',
        'InvalidUserPasswordException' => 'Domain/Exceptions/InvalidUserPasswordException.php',
        'InvalidUserRoleException' => 'Domain/Exceptions/InvalidUserRoleException.php',
        'InvalidUserStatusException' => 'Domain/Exceptions/InvalidUserStatusException.php',
        'UserAlreadyExistsException' => 'Domain/Exceptions/UserAlreadyExistsException.php',
        'UserNotFoundException' => 'Domain/Exceptions/UserNotFoundException.php',
        'InvalidCredentialsException' => 'Domain/Exceptions/InvalidCredentialsException.php',

        'UserRoleEnum' => 'Domain/Enums/UserRoleEnum.php',
        'UserStatusEnum' => 'Domain/Enums/UserStatusEnum.php',

        'UserId' => 'Domain/ValueObjects/UserId.php',
        'UserName' => 'Domain/ValueObjects/UserName.php',
        'UserEmail' => 'Domain/ValueObjects/UserEmail.php',
        'UserPassword' => 'Domain/ValueObjects/UserPassword.php',

        'UserModel' => 'Domain/Models/UserModel.php',
        'EmailDestinationModel' => 'Domain/Models/EmailDestinationModel.php',
        'EmailSenderException' => 'Domain/Exceptions/EmailSenderException.php',
        'EmailSenderPort' => 'Application/Ports/Out/EmailSenderPort.php',
        'EmailNotificationService' => 'Application/Services/EmailNotificationService.php',
        'EmailSenderService' => 'Infrastructure/Adapters/Email/EmailSenderService.php',

        'CreateUserUseCase' => 'Application/Ports/In/CreateUserUseCase.php',
        'UpdateUserUseCase' => 'Application/Ports/In/UpdateUserUseCase.php',
        'GetUserByIdUseCase' => 'Application/Ports/In/GetUserByIdUseCase.php',
        'GetAllUsersUseCase' => 'Application/Ports/In/GetAllUsersUseCase.php',
        'DeleteUserUseCase' => 'Application/Ports/In/DeleteUserUseCase.php',
        'LoginUseCase' => 'Application/Ports/In/LoginUseCase.php',

        'SaveUserPort' => 'Application/Ports/Out/SaveUserPort.php',
        'UpdateUserPort' => 'Application/Ports/Out/UpdateUserPort.php',
        'GetUserByIdPort' => 'Application/Ports/Out/GetUserByIdPort.php',
        'GetUserByEmailPort' => 'Application/Ports/Out/GetUserByEmailPort.php',
        'GetAllUsersPort' => 'Application/Ports/Out/GetAllUsersPort.php',
        'DeleteUserPort' => 'Application/Ports/Out/DeleteUserPort.php',

        'CreateUserCommand' => 'Application/Services/Dto/Commands/CreateUserCommand.php',
        'UpdateUserCommand' => 'Application/Services/Dto/Commands/UpdateUserCommand.php',
        'DeleteUserCommand' => 'Application/Services/Dto/Commands/DeleteUserCommand.php',
        'LoginCommand' => 'Application/Services/Dto/Commands/LoginCommand.php',
        'GetUserByIdQuery' => 'Application/Services/Dto/Queries/GetUserByIdQuery.php',
        'GetAllUsersQuery' => 'Application/Services/Dto/Queries/GetAllUsersQuery.php',

        'CreateUserService' => 'Application/Services/CreateUserService.php',
        'UpdateUserService' => 'Application/Services/UpdateUserService.php',
        'GetUserByIdService' => 'Application/Services/GetUserByIdService.php',
        'GetAllUsersService' => 'Application/Services/GetAllUsersService.php',
        'DeleteUserService' => 'Application/Services/DeleteUserService.php',
        'LoginService' => 'Application/Services/LoginService.php',
        'UserApplicationMapper' => 'Application/Services/Mappers/UserApplicationMapper.php',

        'Connection' => 'Infrastructure/Adapters/Persistence/MySQL/Config/Connection.php',
        'UserPersistenceDto' => 'Infrastructure/Adapters/Persistence/MySQL/Dto/UserPersistenceDto.php',
        'UserEntity' => 'Infrastructure/Adapters/Persistence/MySQL/Entity/UserEntity.php',
        'UserPersistenceMapper' => 'Infrastructure/Adapters/Persistence/MySQL/Mapper/UserPersistenceMapper.php',
        'UserRepositoryMySQL' => 'Infrastructure/Adapters/Persistence/MySQL/Repository/UserRepositoryMySQL.php',

        'CreateUserWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/CreateUserRequest.php',
        'UpdateUserWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/UpdateUserRequest.php',
        'LoginWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/LoginWebRequest.php',
        'UserResponse' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/UserResponse.php',
        'UserWebMapper' => 'Infrastructure/Entrypoints/Web/Controllers/Mapper/UserWebMapper.php',
        'UserController' => 'Infrastructure/Entrypoints/Web/Controllers/UserController.php',
        'WebRoutes' => 'Infrastructure/Entrypoints/Web/Controllers/Config/WebRoutes.php',

        'View' => 'Infrastructure/Entrypoints/Web/Presentation/View.php',
        'Flash' => 'Infrastructure/Entrypoints/Web/Presentation/Flash.php',

        // Student · Dominio
        'InvalidStudentIdException' => 'Domain/Exceptions/InvalidStudentIdException.php',
        'InvalidStudentNameException' => 'Domain/Exceptions/InvalidStudentNameException.php',
        'InvalidStudentLastNameException' => 'Domain/Exceptions/InvalidStudentLastNameException.php',
        'InvalidStudentEmailException' => 'Domain/Exceptions/InvalidStudentEmailException.php',
        'InvalidStudentPhoneException' => 'Domain/Exceptions/InvalidStudentPhoneException.php',
        'InvalidStudentBirthDateException' => 'Domain/Exceptions/InvalidStudentBirthDateException.php',
        'InvalidStudentSemesterException' => 'Domain/Exceptions/InvalidStudentSemesterException.php',
        'InvalidStudentProgramException' => 'Domain/Exceptions/InvalidStudentProgramException.php',
        'InvalidStudentUniversityException' => 'Domain/Exceptions/InvalidStudentUniversityException.php',
        'InvalidStudentGenderException' => 'Domain/Exceptions/InvalidStudentGenderException.php',
        'StudentAlreadyExistsException' => 'Domain/Exceptions/StudentAlreadyExistsException.php',
        'StudentNotFoundException' => 'Domain/Exceptions/StudentNotFoundException.php',

        'StudentGenderEnum' => 'Domain/Enums/StudentGenderEnum.php',

        'StudentId' => 'Domain/ValueObjects/StudentId.php',
        'StudentName' => 'Domain/ValueObjects/StudentName.php',
        'StudentLastName' => 'Domain/ValueObjects/StudentLastName.php',
        'StudentBirthDate' => 'Domain/ValueObjects/StudentBirthDate.php',
        'StudentSemester' => 'Domain/ValueObjects/StudentSemester.php',
        'StudentEmail' => 'Domain/ValueObjects/StudentEmail.php',
        'StudentPhone' => 'Domain/ValueObjects/StudentPhone.php',
        'StudentProgram' => 'Domain/ValueObjects/StudentProgram.php',
        'StudentUniversity' => 'Domain/ValueObjects/StudentUniversity.php',

        'StudentModel' => 'Domain/Models/StudentModel.php',

        'StudentCreatedDomainEvent' => 'Domain/Events/StudentCreatedDomainEvent.php',
        'StudentUpdatedDomainEvent' => 'Domain/Events/StudentUpdatedDomainEvent.php',
        'StudentDeletedDomainEvent' => 'Domain/Events/StudentDeletedDomainEvent.php',

        // Student · Aplicacion
        'CreateStudentUseCase' => 'Application/Ports/In/CreateStudentUseCase.php',
        'UpdateStudentUseCase' => 'Application/Ports/In/UpdateStudentUseCase.php',
        'GetStudentByIdUseCase' => 'Application/Ports/In/GetStudentByIdUseCase.php',
        'GetAllStudentsUseCase' => 'Application/Ports/In/GetAllStudentsUseCase.php',
        'DeleteStudentUseCase' => 'Application/Ports/In/DeleteStudentUseCase.php',

        'SaveStudentPort' => 'Application/Ports/Out/SaveStudentPort.php',
        'UpdateStudentPort' => 'Application/Ports/Out/UpdateStudentPort.php',
        'GetStudentByIdPort' => 'Application/Ports/Out/GetStudentByIdPort.php',
        'GetStudentByEmailPort' => 'Application/Ports/Out/GetStudentByEmailPort.php',
        'GetAllStudentsPort' => 'Application/Ports/Out/GetAllStudentsPort.php',
        'DeleteStudentPort' => 'Application/Ports/Out/DeleteStudentPort.php',

        'CreateStudentCommand' => 'Application/Services/Dto/Commands/CreateStudentCommand.php',
        'UpdateStudentCommand' => 'Application/Services/Dto/Commands/UpdateStudentCommand.php',
        'DeleteStudentCommand' => 'Application/Services/Dto/Commands/DeleteStudentCommand.php',
        'GetStudentByIdQuery' => 'Application/Services/Dto/Queries/GetStudentByIdQuery.php',
        'GetAllStudentsQuery' => 'Application/Services/Dto/Queries/GetAllStudentsQuery.php',

        'CreateStudentService' => 'Application/Services/CreateStudentService.php',
        'UpdateStudentService' => 'Application/Services/UpdateStudentService.php',
        'GetStudentByIdService' => 'Application/Services/GetStudentByIdService.php',
        'GetAllStudentsService' => 'Application/Services/GetAllStudentsService.php',
        'DeleteStudentService' => 'Application/Services/DeleteStudentService.php',
        'StudentApplicationMapper' => 'Application/Services/Mappers/StudentApplicationMapper.php',

        // Student · Infraestructura
        'StudentPersistenceDto' => 'Infrastructure/Adapters/Persistence/MySQL/Dto/StudentPersistenceDto.php',
        'StudentEntity' => 'Infrastructure/Adapters/Persistence/MySQL/Entity/StudentEntity.php',
        'StudentPersistenceMapper' => 'Infrastructure/Adapters/Persistence/MySQL/Mapper/StudentPersistenceMapper.php',
        'StudentRepositoryMySQL' => 'Infrastructure/Adapters/Persistence/MySQL/Repository/StudentRepositoryMySQL.php',

        // Student · Entrypoints
        'CreateStudentWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/CreateStudentRequest.php',
        'UpdateStudentWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/UpdateStudentRequest.php',
        'StudentResponse' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/StudentResponse.php',
        'StudentWebMapper' => 'Infrastructure/Entrypoints/Web/Controllers/Mapper/StudentWebMapper.php',
        'StudentController' => 'Infrastructure/Entrypoints/Web/Controllers/StudentController.php',
        'StudentFormHelper' => 'Infrastructure/Entrypoints/Web/Controllers/Config/StudentFormHelper.php',

        'DependencyInjection' => 'Common/DependencyInjection.php',
    );

    public static function register(): void
    {
        spl_autoload_register(array(self::class, 'loadClass'));
    }

    public static function loadClass(string $className): void
    {
        if (!isset(self::$classMap[$className])) {
            return;
        }

        $baseDir = dirname(__DIR__) . DIRECTORY_SEPARATOR;
        $filePath = $baseDir . self::$classMap[$className];

        if (!file_exists($filePath)) {
            throw new RuntimeException(
                sprintf('No se encontró el archivo para la clase %s en %s', $className, $filePath)
            );
        }

        require_once $filePath;
    }
}